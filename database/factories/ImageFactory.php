<?php

use Faker\Generator as Faker;
use App\Models\Image;

$factory->define(Image::class, function (Faker $faker) {
    return [        
        'path' => str_random(15),
    ];
});
