<?php

use Faker\Generator as Faker;
use App\Models\OrderDetail;

$factory->define(OrderDetail::class, function (Faker $faker) {
    return [
        'price' => rand(100000, 1000000),
        'quantity' => rand(50 , 100),
    ];
});
