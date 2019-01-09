<?php

use Illuminate\Database\Seeder;
use App\Models\Code;
use App\Models\Category;

class CodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ids = Category::where('parent_id', 1)->select('id')->get();
        for($i = 0; $i < 10; $i++){
            factory(Code::class)->create([
                'category_id' => array_random([null, $ids->random()])
            ]);
        }
    }
}
