<?php

use App\Village;
use Faker\Generator as Faker;

$factory->define(Village::class, function (Faker $faker) {
    return [
        'user_id' => 0,
        'name'    => 'wioska barbarzyńska',
        'x'       => rand(1, 100),
        'y'       => rand(1, 100),
    ];
});
