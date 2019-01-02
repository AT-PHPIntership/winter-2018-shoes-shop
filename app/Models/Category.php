<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
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
}