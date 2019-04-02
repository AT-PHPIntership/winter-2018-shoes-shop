<?php

namespace App\Services;

use App\Models\Review;
use App\Models\Product;
use Log;
use DB;

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
}
