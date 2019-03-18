<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'category_id', 'original_price', 'quantity', 'description'
    ];

    /**
     * Get list product details belong to product.
     *
     * @return void
     */
    public function productDetails()
    {
        return $this->hasMany('App\Models\ProductDetail');
    }

    /**
     * Get list images belong to product.
     *
     * @return void
     */
    public function images()
    {
        return $this->hasMany('App\Models\Image');
    }

    /**
     * Get the category for this product.
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    /**
     * Product belong to promotion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'product_promotions');
    }
}
