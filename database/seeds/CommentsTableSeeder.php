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
        for($i = 0; $i < 5; $i++){
            factory(Comment::class)->create([
                'product_id' => $product_ids->random(),
                'user_id' => $user_ids->random(),
            ]);
        }
        $comment_ids = Comment::all('id');
        for($i = 0; $i < 5; $i++){
            factory(Comment::class)->create([
                'parent_id' => $comment_ids->random(),
                'product_id' => $product_ids->random(),
                'user_id' => $user_ids->random(),
            ]);
        }
    }
}
