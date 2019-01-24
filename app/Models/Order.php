<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const PENDING_STATUS = 0;
    const CONFIRMED_STATUS = 1;
    const PROCESSING_STATUS = 2;
    const QUALITY_CHECK_STATUS = 4;
    const DISPATCHED_ITEM_STATUS = 5;
    const DELIVERED_STATUS = 6;
    const CANCELED_STATUS = 7;

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
}
