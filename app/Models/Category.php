<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table = 'categories';

    /**
     * Get the children for categories.
     *
     * @return void
     */
    public function children()
    {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    }

    /**
     * Get the parent for categories.
     *
     * @return void
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id', 'id');
    }

    /**
     * Category has many users
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function codes()
    {
        return $this->hasMany(Code::class);
    }
}
