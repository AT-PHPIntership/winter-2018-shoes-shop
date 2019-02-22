<?php

namespace App\Services;

use App\Models\Order;
use Log;

class OrderService
{
    /**
     * Get all data table orders
     *
     * @return object
     */
    public function getOrderWithPaginate()
    {
        return Order::with(['code:id,name', 'user:id', 'user.profile:user_id,name'])->orderBy('id', 'desc')->paginate(config('define.paginate.limit_rows'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param array $data  data
     * @param Order $order order
     *
     * @return Order
     */
    public function update(array $data, Order $order)
    {
        try {
            $order->update($data);
            return $order;
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }

    /**
     * Get order by id
     *
     * @param int $id id
     *
     * @return object
     */
    public function getOrderById($id)
    {
        return Order::with(['code:id,name', 'user:id', 'user.profile:id,name,user_id', 'orderDetails', 'orderDetails.product:id,name,original_price,category_id', 'orderDetails.product.category:id,name'])->findOrFail($id);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param order $order order
    *
    * @return Order
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

    /**
     * Get own orders
     *
     * @return object
     */
    public function getAuthOrderWithPaginate()
    {
        $user_id = \Auth::user()->id;
        $orders = Order::where('user_id', $user_id)->orderBy('id', 'desc')->paginate(config('define.paginate.number_order'));
        return $orders;
    }
}
