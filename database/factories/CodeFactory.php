<?php

use Faker\Generator as Faker;
use App\Models\Code;

$factory->define(Code::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'percent' => $faker->numberBetween(1,100),
        'description' => $faker->text(40),
        'times' => $faker->randomNumber(3),
        'start_date' => date('Y-m-d'),
        'end_date' => $faker->dateTimeBetween('+1 week', '+1 month'),
    ];
});
