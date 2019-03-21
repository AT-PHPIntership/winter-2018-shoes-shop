<?php

namespace App\Services;

use App\Models\Review;
use Log;
use File;

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
}
