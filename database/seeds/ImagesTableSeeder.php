<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Image;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('images')->truncate();
        $product_ids = Product::all('id');
        for ($i = 0; $i < 10; $i++) {
            factory(Image::class)->create([
                'product_id' => $product_ids->random(),
            ]);
        } 
    }
}
