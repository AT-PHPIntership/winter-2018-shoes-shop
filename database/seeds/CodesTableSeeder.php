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
        $ids = Category::all('id');
        for($i = 0; $i < 10; $i++){
            factory(Role::class)->create([
                'category_id' => $ids->random()
            ]);
        }
    }
}
