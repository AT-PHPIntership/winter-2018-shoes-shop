<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\ProductPromotion;

class ProductPromotionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productIds = Product::all('id');
        $promotionIds = Promotion::all('id');
        for($i = 0; $i < 10; $i++){
            factory(ProductPromotion::class)->create([
                'product_id' => $productIds->random(),
                'promotion_id' => $promotionIds->random(),
            ]);
        }
    }
}
