<?php

namespace App\Services;

use App\Models\Review;

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
}
