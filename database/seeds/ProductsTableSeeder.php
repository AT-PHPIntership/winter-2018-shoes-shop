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
        \DB::table('products')-> insert([
                'name' => 'Giày nam',
                'parent_id' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
        ]);
        $ids = Category::all('id');
        for ($i=0; $i < 10; $i++) {
            factory(Product::class)->create([
                'category_id' => $ids->random()
            ]);
        }
    }
}
