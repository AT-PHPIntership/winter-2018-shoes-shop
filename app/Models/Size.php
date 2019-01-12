<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    /**
     * Get list product details belong to size.
     *
     * @return void
     */
    public function productDetails()
    {
        return $this->hasMany('App\Models\ProductDetail');
    }
}
