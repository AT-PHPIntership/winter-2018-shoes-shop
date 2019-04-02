<?php

namespace App\Services;

use App\Models\Review;
use App\Models\Order;
use App\Models\Image;
use DB;
use Log;
use Auth;

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
}
