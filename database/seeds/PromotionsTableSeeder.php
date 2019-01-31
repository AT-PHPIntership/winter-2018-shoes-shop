<?php

use Illuminate\Database\Seeder;
use App\Models\Promotion;

class PromotionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Promotion::class, 10)->create();
    }
}
