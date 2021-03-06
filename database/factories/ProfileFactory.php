<?php

use Faker\Generator as Faker;
use App\Models\Profile;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'gender' => $faker->randomElement([Profile::MALE, Profile::FEMALE, Profile::OTHER]),
        'phonenumber' => '09'.$faker->randomNumber(8),
        'avatar' => $faker->imageUrl(200,200),
        'address' => $faker->address
    ];
});
