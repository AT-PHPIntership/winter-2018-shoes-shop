<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    /**
     * Get list product details belong to color.
     *
     * @return void
     */
    public function productDetails()
    {
        return $this->hasMany('App\Models\ProductDetail');
    }
}
