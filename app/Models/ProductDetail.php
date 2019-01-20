<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    /**
     * Get the color for product detail.
     *
     * @return void
     */
    public function color()
    {
        return $this->belongsTo('App\Models\Color');
    }

    /**
     * Get the size for product detail.
     *
     * @return void
     */
    public function size()
    {
        return $this->belongsTo('App\Models\Size');
    }

    /**
     * Get the product for product detail.
     *
     * @return void
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
