<?php

namespace App\Services;

use App\Models\Review;

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
}
