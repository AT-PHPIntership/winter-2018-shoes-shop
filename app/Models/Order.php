<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const PENDING_STATUS = 0;
    const APPROVED_STATUS = 1;
    const DELIVERED_STATUS = 2;
    const DENIED_STATUS = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'code_id', 'ordered_at', 'shipped_at', 'ship_to', 'phone_to', 'price', 'status',
    ];
}
