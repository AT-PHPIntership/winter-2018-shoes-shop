<?php

use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('colors')->truncate();
        \DB::table('colors')-> insert([
            [
                'name' => 'Trắng',
            ], [
                'name' => 'Đen',
            ], [
                'name' => 'Hồng',
            ], [
                'name' => 'Tím',
            ], [
                'name' => 'Đỏ',
            ], [
                'name' => 'Cam',
            ], [
                'name' => 'Vàng',
            ], [
                'name' => 'Xám',
            ], [
                'name' => 'Hồng',
            ], [
                'name' => 'Nâu',
            ], [
                'name' => 'Xanh mi nơ',
            ], [
                'name' => 'Xanh dương',
            ], [
                'name' => 'Vàng kim',
            ]
        ]);
    }
}
