<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    /**
     * Get all data table codes
     *
     * @return object
     */
    public function getOrderWithPaginate()
    {
        return Order::with(['code', 'orderDetails'])->orderBy('id', 'desc')->paginate(config('define.paginate.limit_rows'));
    }
}
