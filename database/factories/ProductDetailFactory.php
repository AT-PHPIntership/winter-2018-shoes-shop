<?php

use Faker\Generator as Faker;
use App\Models\ProductDetail;

$factory->define(ProductDetail::class, function (Faker $faker) {
    return [
        'quantity' => rand(1 , 20),
        'total_sold' => rand(0 , 5),
    ];
});
