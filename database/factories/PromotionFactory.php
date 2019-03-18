<?php

use Faker\Generator as Faker;
use App\Models\Promotion;

$factory->define(Promotion::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'percent' => $faker->numberBetween(1,100),
        'description' => $faker->text(40),
        'total_sold' => $faker->randomNumber(1),
        'start_date' => date('Y-m-d'),
        'end_date' => $faker->dateTimeBetween('+1 week', '+1 month'),
    ];
});
