<?php

use Faker\Generator as Faker;
use App\Models\Order;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'delivered_at' => $faker->dateTimeBetween('+1 day', '+3 day'),
        'customer_name' => $faker->name,
        'shipping_address' => $faker->address,
        'phone_number' => '09'.$faker->randomNumber(8),
        'total_amount' => rand(100000, 1000000),
        'status' => array_random([Order::ORDER_STATUS['CONFIRMED'], Order::ORDER_STATUS['PROCESSING'], Order::ORDER_STATUS['QUALITY_CHECK'], Order::ORDER_STATUS['DISPATCHED_ITEM'], Order::ORDER_STATUS['DELIVERED'], Order::ORDER_STATUS['CANCELED'], Order::ORDER_STATUS['PENDING']]),
    ];
});
