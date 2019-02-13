<?php

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;

class OrderDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orderIds = Order::all('id');
        $productIds = Product::all('id');
        for($i = 0; $i < 20; $i++){
            factory(OrderDetail::class)->create([
                'order_id' => $orderIds->random(),
                'product_id' => $productIds->random(),
            ]);
        }
    }
}
