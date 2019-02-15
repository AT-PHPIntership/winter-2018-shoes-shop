<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\Code;
use App\Models\OrderDetail;
use App\Models\ProductDetail;
use Carbon\Carbon;
use Log;
use DB;

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
        DB::beginTransaction();
        try {
            $products = data_get($arrProduct, '*.product');
            if ($code) {
                $code = Code::where('name', $code['name'])->where('times', '>', 0)->first();
            }
            $totalAmount = $this->getTotalAmount($products, $code);
            $order = Order::create([
                'code_id' => $code ? $code->id : null,
                'customer_name' => $customer['customerName'],
                'shipping_address' => $customer['shippingAddress'],
                'phone_number' => $customer['phoneNumber'],
                'total_amount' => $totalAmount,
            ]);
            foreach ($arrProduct as $val) {
                $price = $this->getPrice($val['product']['id']);
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $val['product']['id'],
                    'price' => $price,
                    'quantity' => $val['product']['quantity'],
                    'size' => $val['size']['name'],
                    'color' => $val['color']['name'],
                ]);
                ProductDetail::where('product_id', $val['product']['id'])
                ->where('color_id', $val['color']['id'])
                ->where('size_id', $val['size']['id'])
                ->increment('total_sold', $val['product']['quantity']);
                Product::where('id', $val['product']['id'])
                ->increment('total_sold', $val['product']['quantity']);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
        }
        return false;
    }

    /**
     * Get total amount
     *
     * @param array $products products
     * @param Code  $code     code
     *
     * @return decimal
     */
    public function getTotalAmount(array $products, Code $code = null)
    {
        try {
            $totalAmount = 0;
            foreach ($products as $value) {
                $price = $this->getPrice($value['id']);
                $totalAmount += $price * $value['quantity'];
            }
            if ($code) {
                $totalAmount -= app(CodeService::class)->getDecreaseTotalAmount($code->name, $products);
            }
            return $totalAmount;
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }

    /**
     * Get price product with promotions
     *
     * @param int $productId productId
     *
     * @return decimal
     */
    public function getPrice(int $productId)
    {
        try {
            $product = Product::with(['promotions' => function ($query) {
                $query->where('start_date', '<=', Carbon::now())
                        ->where('end_date', '>=', Carbon::now())
                        ->whereRaw('max_sell - total_sold > 0');
            }])->find($productId);
            if ($product->promotions->last()) {
                $price = $product->original_price * (100 - $product->promotions->last()->percent) / 100;
            } else {
                $price = $product->original_price;
            }
            return $price;
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }
}
