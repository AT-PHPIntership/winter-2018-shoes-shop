<?php

use Faker\Generator as Faker;
use App\Models\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => str_random(10),
        'original_price' => rand(100000, 1000000),
        'description' => str_random(20),
        'quantity' => rand(50 , 100),
        'total_sold' => rand(0 , 10),
    ];
});
