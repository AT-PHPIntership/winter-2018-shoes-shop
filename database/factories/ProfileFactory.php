<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\Models\User::class)->create()->id,
        'name' => $faker->name,
        'gender' => $faker->randomElement([0,1,2]),
        'phonenumber' => '09'.$faker->randomNumber(9),
        'avatar' => $faker->imageUrl($width = 200, $height = 200),
        'address' => $faker->address
    ];
});
