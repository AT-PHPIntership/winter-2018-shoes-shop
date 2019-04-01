<?php

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Like;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $previewIds = Review::all('id');
        $userIds = User::all('id');
        for($i = 0; $i < 40; $i++){
            factory(Like::class)->create([
                'review_id' => $previewIds->random(),
                'user_id' => $userIds->random(),
            ]);
        }
    }
}
