<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\Code;
use Carbon\Carbon;
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
     * Handle add order
     *
     * @param array $code       [name, percent]
     * @param array $arrProduct [[product => [id,name,price,quantity]], [color => [id,name]], [size => [id,name]]]
     * @param array $customer   [customerName, phoneNumber, shippingAddress]
     *
     * @return boolean
     */
    public function order(array $code = null, array $arrProduct, array $customer)
    {
        try {
            $products = data_get($arrProduct, '*.product');
            if ($code) {
                $code = Code::where('name', $code['name'])->where('times', '>', 0)->first();
            }
            $totalAmount = $this->getTotalAmount($products, $code);
            // $totalAmount = $code ? $this->getTotalAmount($products,$code) : $this->getTotalAmount($products);
            // $code = Code::where('name', $code->name)->first('id');
            // Order::create([
            //     'code_id' => $code->id,
            //     'customer_name' => $customer->customerName,
            //     'shipping_address' => $customer->shippingAddress,
            //     'phone_number' => $customer->phoneNumber,
            //     'total_amount' => 
            // ]);
            // $a = $this->getTotalAmount($arrProduct,$code);
            // $a = array_only($arrProduct, ['*.product']);;
            // [$keys, $a] = array_divide($arrProduct);
            // $a = data_get($arrProduct, '*.product');
            \Log::debug($totalAmount);
            // return $order;
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }

    /**
     * Get total amount
     *
     * @param array $products products
     * @param Code  $code     code
     *
     * @return boolean
     */
    public function getTotalAmount(array $products, Code $code = null)
    {
        try {
            $totalAmount = 0;
            foreach ($products as $value) {
                $product = Product::with(['promotions' => function ($query) {
                    $query->where('start_date', '<=', Carbon::now())
                          ->where('end_date', '>=', Carbon::now())
                          ->where('max_sell', '>', 0);
                }])->find($value['id']);
                if ($product->promotions->last()) {
                    $price = $product->original_price * (100 - $product->promotions->last()->percent) / 100;
                } else {
                    $price = $product->original_price;
                }
                if ($code) {
                    $totalAmount += $price * $value['quantity'] * (100 - $code->percent) / 100 ;
                } else {
                    $totalAmount += $price * $value['quantity'];
                }
            }
            return $totalAmount;
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }
}
