<?php

namespace App\Services;

use App\Models\Review;
use App\Models\Order;
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
        return Review::select('star', \DB::raw('count(*) as total'))->groupBy('star')->get();
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
            $order = Order::join('order_details', 'orders.id', '=', 'order_details.order_id')->where('user_id', $data['user_id'])->where('product_id', $data['product_id'])->first();
            $order ? $isBuy = 1 : $isBuy = 0;
            $review = Review::create([
                'user_id' => $data['user_id'],
                'is_buy' => $isBuy,
                'product_id' => $data['product_id'],
                'title' => $data['title'],
                'content' => $data['content'],
                'star' => $data['star'],
            ]);
            if (isset($data['image'])) {
                foreach ($data['image'] as $image) {
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
