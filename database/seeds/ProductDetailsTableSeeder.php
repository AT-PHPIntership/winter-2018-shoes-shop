<?php

use Illuminate\Database\Seeder;
use App\Models\ProductDetail;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;

class ProductDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('product_details')->truncate();
        $product_ids = Product::all('id');
        $size_ids = Size::all('id');
        $color_ids = Color::all('id');
        for ($i= 0; $i < 40; $i++) { 
            factory(ProductDetail::class)->create([
                'product_id' => $product_ids->random(),
                'size_id' => $size_ids->random(),
                'color_id' => $color_ids->random()
            ]);
        }
    }
}
