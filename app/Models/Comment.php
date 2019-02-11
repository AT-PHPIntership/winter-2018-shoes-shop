<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    const ACTIVE_STATUS = 1;
    const BLOCKED_STATUS = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id', 'parent_id', 'content', 'comment'
    ];
}
