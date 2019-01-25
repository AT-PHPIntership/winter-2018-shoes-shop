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
        'status' => array_random([Order::PENDING_STATUS, Order::CONFIRMED_STATUS, Order::PROCESSING_STATUS, Order::QUALITY_CHECK_STATUS, Order::DISPATCHED_ITEM_STATUS, Order::DELIVERED_STATUS, Order::CANCELED_STATUS]),
    ];
});
