<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'path'
    ];

    /**
     * Get the product for this image.
     *
     * @return void
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }


    /**
     * Get the image.
     *
     * @param string $path image name
     *
     * @return string
     */
    public function getPathAttribute($path)
    {
        return '/upload/'.$path;
    }
}
