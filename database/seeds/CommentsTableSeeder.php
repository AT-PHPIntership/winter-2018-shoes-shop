<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;
use App\Models\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_ids = Product::all('id');
        $user_ids = User::all('id');
        for($i = 1; $i < 11; $i++){
            factory(Comment::class)->create([
                'parent_id' => array_random([null, $i]),
                'product_id' => $product_ids->random(),
                'user_id' => $user_ids->random(),
            ]);
        }
    }
}
