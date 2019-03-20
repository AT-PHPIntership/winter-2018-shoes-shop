<?php

use Faker\Generator as Faker;
use App\Models\Review;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'star' => array_random(Review::NUMBER_STAR),
        'content' => $faker->text(30),
        'status' => $faker->randomElement([Review::ACTIVE_STATUS, Review::BLOCKED_STATUS]),
    ];
});
