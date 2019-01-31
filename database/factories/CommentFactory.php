<?php

use Faker\Generator as Faker;
use App\Models\Comment;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => str_random(50),
        'status' => $faker->randomElement([Comment::ACTIVE_STATUS, Comment::BLOCKED_STATUS]),
    ];
});
