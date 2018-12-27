<?php

use Faker\Generator as Faker;
use App\Models\Profile;
use App\Models\User;

$factory->define(App\Models\Profile::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'gender' => $faker->randomElement([Profile::MALE, Profile::FEMALE, Profile::OTHER]),
        'phonenumber' => '09'.$faker->randomNumber(8),
        'avatar' => $faker->imageUrl(200,200),
        'address' => $faker->address
    ];
});
