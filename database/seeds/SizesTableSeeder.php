<?php

use Illuminate\Database\Seeder;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sizes')->truncate();
        for ($i = 24; $i < 46; $i++) {
            \DB::table('sizes')-> insert([
                [
                    'size' => $i,
                ]
            ]);
        }
    }
}
