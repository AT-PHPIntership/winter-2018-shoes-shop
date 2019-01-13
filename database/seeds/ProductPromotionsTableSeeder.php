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
        $product_ids = Product::all('id');
        $promotion_ids = Promotion::all('id');
        for($i = 0; $i < 5; $i++){
            factory(ProductPromotion::class)->create([
                'product_id' => $product_ids->random(),
                'promotion_id' => $promotion_ids->random(),
            ]);
        }
    }
}
