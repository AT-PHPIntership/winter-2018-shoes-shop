<?php

use Faker\Generator as Faker;
use App\Models\Comment;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->text(30),
        'status' => $faker->randomElement([Comment::ACTIVE_STATUS, Comment::BLOCKED_STATUS]),
    ];
});
