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
        return Review::with(['product:id,name', 'product.images', 'images'])->where('user_id', Auth::user()->id)->paginate(config('define.paginate.number_order'));
    }
}
