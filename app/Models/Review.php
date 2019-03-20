<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    const ACTIVE_STATUS = 1;
    const BLOCKED_STATUS = 0;
    const NUMBER_STAR = [
        'ONE' => 1,
        'TWO' => 2,
        'THREE' => 3,
        'FOUR' => 4,
        'FIVE' => 5,
    ];

    /**
     * Get all of the image's reviews.
     */
    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }
}
