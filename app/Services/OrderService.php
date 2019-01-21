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
    * Remove the specified resource from storage.
    *
    * @param order $order order
    *
    * @return \Illuminate\Http\Response
    */
    public function destroy(Order $order)
    {
        try {
            return $order->delete();
        } catch (\Exception $e) {
            Log::error($e);
        }
        return false;
    }
}
