<?php

use Faker\Generator as Faker;
use App\Models\Order;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'ordered_at' => date('Y-m-d'),
        'shipped_at' => $faker->dateTimeBetween('+1 day', '+3 day'),
        'ship_to' => $faker->address,
        'phone_to' => '09'.$faker->randomNumber(8),
        'price' => rand(100000, 1000000),
        'status' => rand(0, 3),
    ];
});
