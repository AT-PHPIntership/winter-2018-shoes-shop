<?php

namespace App\Services;

use App\Models\Review;
use Auth;

class ReviewService
{
    /**
     * Get list review by user
     *
     * @return object
     */
    public function getListReviewByUser()
    {
        return Review::where('user_id', Auth::user()->id)->get();
    }
}
