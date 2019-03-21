<?php

use Illuminate\Database\Seeder;
use App\Models\Image;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = array_random(['products', 'reviews']);
        $model = array_random(['App\Models\Product', 'App\Models\Review']);
        $ids = $model::all('id');
        for ($i = 0; $i < 20; $i++) {
            factory(Image::class)->create([
                'imageable_type' => $table,
                'imageable_id' => $ids->random()->id,
            ]);
        }
    }
}
