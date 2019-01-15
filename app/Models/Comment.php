<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id', 'parent_id', 'content',
    ];
    
    /**
     * Comment belong to User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Comment belong to Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Parent Comment has many Child Comment
     *
     * @return void
     */
    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    /**
     * Child Comment belong to Parent Comment
     *
     * @return void
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id', 'id');
    }
}
