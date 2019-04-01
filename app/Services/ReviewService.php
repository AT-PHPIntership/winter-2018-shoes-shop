<?php

namespace App\Services;

use App\Models\Review;
use App\Models\Order;
use App\Models\Image;
use DB;
use Log;
use Auth;
use Exception;

class ReviewService
{
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
            $order = Order::join('order_details', 'orders.id', '=', 'order_details.order_id')->where('user_id', Auth::user()->id)->where('product_id', $data['product_id'])->first();
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
