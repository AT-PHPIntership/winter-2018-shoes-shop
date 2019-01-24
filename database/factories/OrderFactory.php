<?php

use Faker\Generator as Faker;
use App\Models\Order;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'delivered_at' => $faker->dateTimeBetween('+1 day', '+3 day'),
        'buyer_name' => $faker->name,
        'shipping_address' => $faker->address,
        'phone_number' => '09'.$faker->randomNumber(8),
        'amount' => rand(100000, 1000000),
        'status' => rand(0, 7),
    ];
});
