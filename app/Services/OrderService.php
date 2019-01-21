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
        return Order::with(['user', 'code'])->orderBy('id', 'desc')->paginate(config('define.paginate.limit_rows'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param array            $data  data
     * @param App\Models\Order $order order
     *
     * @return \Illuminate\Http\Response
     */
    public function update(array $data, Order $order)
    {
        try {
            $order->update($data);
            return $order;
        } catch (\Exception $e) {
            Log::error($e);
        }
    }
}
