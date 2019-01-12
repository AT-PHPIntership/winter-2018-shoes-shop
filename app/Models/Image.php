<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * Get the product for this image.
     *
     * @return void
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
