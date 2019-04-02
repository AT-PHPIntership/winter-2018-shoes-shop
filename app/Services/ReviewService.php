<?php

namespace App\Services;

use App\Models\Review;
use App\Models\Product;
use App\Models\Order;
use App\Models\Image;
use Log;
use DB;
use File;
use Auth;
use Exception;

class ReviewService
{
    /**
     * Get all data table reviews
     *
     * @return Review
     */
    public function getReviewWithPaginate()
    {
        return Review::with(['user:id', 'user.profile:id,user_id,name', 'product:id,name', 'images'])->orderBy('id', 'desc')->paginate(config('define.paginate.limit_rows'));
    }

    /**
     * Change status review
     *
     * @param int $status status
     * @param int $id     id
     *
     * @return boolean
     */
    public function changeStatus(int $status, int $id)
    {
        DB::beginTransaction();
        try {
            $review = Review::find($id);
            if ($review->status == $status) {
                return false;
            }
            $product = Product::find($review->product_id);
            if ($status == Review::ACTIVE_STATUS) {
                $newTotalReview = $product->total_review + 1;
                $newAvgRating = ($product->total_review * $product->avg_rating + $review->star) / $newTotalReview;
            } else {
                $newTotalReview = $product->total_review -1;
                $newAvgRating = ($product->total_review * $product->avg_rating - $review->star) / $newTotalReview;
            }
            $product->update([
                'total_review' => $newTotalReview,
                'avg_rating' => $newAvgRating,
            ]);
            $review = Review::where('id', $id)->update(['status' => $status]);
            DB::commit();
            return $review;
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
        }
        return false;
    }
    
    /**
     * Remove review
     *
     * @param Review $review review
     *
     * @return boolean
     */
    public function destroy(Review $review)
    {
        try {
            $review->delete();
            if (!$review->images->isEmpty()) {
                foreach ($review->images as $image) {
                    $image->delete();
                    File::delete(public_path($image->path));
                }
            }
            return $review;
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }

    /**
     * Get total rating by star
     *
     * @return object
     */
    public function getTotalRatingByStar()
    {
        return Review::where('status', Review::ACTIVE_STATUS)->select('star', \DB::raw('count(*) as total'))->groupBy('star')->get();
    }

    /**
     * Add review
     *
     * @param array $data data
     *
     * @return object
     */
    public function addReview($data)
    {
        DB::beginTransaction();
        try {
            $countReview = Review::where('product_id', $data['product_id'])->where('user_id', Auth::user()->id)->count();
            if ($countReview > 1) {
                return false;
            }
            $order = Order::join('order_details', 'orders.id', '=', 'order_details.order_id')
                            ->where('user_id', Auth::user()->id)
                            ->where('product_id', $data['product_id'])
                            ->where('status', Order::ORDER_STATUS['DELIVERED'])
                            ->first();
            $order ? $isBuy = 1 : $isBuy = 0;
            $review = Review::create([
                'user_id' => Auth::user()->id,
                'is_buy' => $isBuy,
                'product_id' => $data['product_id'],
                'title' => $data['title'],
                'content' => $data['content'],
                'star' => $data['star'],
                'status' => Review::BLOCKED_STATUS,
            ]);
            if (isset($data['images'])) {
                foreach ($data['images'] as $image) {
                    Image::create([
                        'imageable_type' => 'reviews',
                        'imageable_id' => $review->id,
                        'path' => $this->uploadImage($image)
                    ]);
                }
            }
            DB::commit();
            return $review;
        } catch (Exception $e) {
            Log::error($e);
            DB::rollback();
        }
    }

    /**
     * Upload Image
     *
     * @param array $image files
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadImage($image)
    {
        $fileName = time().'-'.$image->getClientOriginalName();
        $image->move('upload', $fileName);
        return $fileName;
    }

    /**
     * Get list review
     *
     * @param array $data data
     *
     * @return object
     */
    public function getListReview($data)
    {
        $review = Review::with(['user:id','user.profile:user_id,name,avatar', 'product:id,name', 'images', 'likes'])
            ->withCount('likes')
            ->where('product_id', $data['productId'])
            ->where('status', Review::ACTIVE_STATUS);
        if ($data['isBuy'] == 1) {
            $review->where('is_buy', 1);
        }
        if ($data['star'] != 0) {
            $review->where('star', $data['star']);
        }
        if ($data['sort'] == 0) {
            $review->orderBy('likes_count', 'desc');
        } else {
            $review->orderBy('updated_at', 'desc');
        }
        return $review->paginate(config('define.paginate.limit_rows_comment'));
    }
}
