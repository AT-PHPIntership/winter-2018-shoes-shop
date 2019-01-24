<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'code_id', 'delivered_at', 'buyer_name', 'shipping_address', 'phone_number', 'amount', 'status',
    ];
}
