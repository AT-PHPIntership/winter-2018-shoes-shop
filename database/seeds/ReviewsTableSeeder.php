<?php

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Product;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productIds = Product::all('id');
        $userIds = User::all('id');
        for($i = 0; $i < 40; $i++){
            factory(Review::class)->create([
                'product_id' => $productIds->random(),
                'user_id' => $userIds->random(),
            ]);
        }
    }
}
