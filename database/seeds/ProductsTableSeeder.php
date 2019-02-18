<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('products')->truncate();
        $ids = Category::all('id');
        for ($i=0; $i < 40; $i++) {
            factory(Product::class)->create([
                'category_id' => $ids->random()
            ]);
        }
    }
}
