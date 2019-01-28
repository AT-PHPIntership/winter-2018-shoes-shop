<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const ORDER_STATUS = [
        'PENDING' => 0,
        'CONFIRMED' => 1,
        'PROCESSING' => 2,
        'QUALITY_CHECK' => 3,
        'DISPATCHED_ITEM' => 4,
        'DELIVERED' => 5,
        'CANCELED' => 6,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'code_id', 'delivered_at', 'customer_name', 'shipping_address', 'phone_number', 'amount', 'status',
    ];

    /**
     * Order belong to User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Order belong to code
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function code()
    {
        return $this->belongsTo(Code::class);
    }

    /**
     * Order has many orderDetails
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
