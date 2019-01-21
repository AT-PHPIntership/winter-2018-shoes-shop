<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const PENDING_STATUS = 0;
    const APPROVE_STATUS = 1;
    const COMPLETE_STATUS = 2;
    const CANCEL_STATUS = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'code_id', 'ordered_at', 'shipped_at', 'ship_to', 'phone_to', 'price', 'status',
    ];

    /**
     * Get the status.
     *
     * @param string $status status
     *
     * @return string
     */
    public function getStatusAttribute($status)
    {
        switch ($status) {
            case self::APPROVE_STATUS:
                return config('define.orderStatus.approve');
            case self::COMPLETE_STATUS:
                return config('define.orderStatus.complete');
            case self::CANCEL_STATUS:
                return config('define.orderStatus.cancel');
            default:
                return config('define.orderStatus.pending');
        }
    }

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
