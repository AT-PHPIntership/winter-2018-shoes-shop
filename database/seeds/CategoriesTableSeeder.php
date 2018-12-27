<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->truncate();
        \DB::table('categories')-> insert([
            [
                'name' => 'Giày nam',
                'parent_id' => 0,
                'delete_flag' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ], [
                'name' => 'Giày thể thao',
                'parent_id' => 1,
                'delete_flag' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],[
                'name' => 'Giày tây',
                'parent_id' => 1,
                'delete_flag' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],[
                'name' => 'Giày nữ',
                'parent_id' => 0,
                'delete_flag' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],[
                'name' => 'Giày trẻ em',
                'parent_id' => 0,
                'delete_flag' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],[
                'name' => 'Phụ kiện',
                'parent_id' => 0,
                'delete_flag' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ]);
    }
}
