<?php

use Faker\Generator as Faker;
use App\Models\OrderDetail;

$factory->define(OrderDetail::class, function (Faker $faker) {
    return [
        'price' => rand(90000, 900000),
        'quantity' => rand(50 , 100),
    ];
});
