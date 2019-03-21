<?php

namespace App\Services;

use App\Models\Review;
use Log;

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
        try {
            return Review::where('id', $id)->update(['status' => $status]);
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }
}
