<?php

use App\Setting;
use Faker\Generator as Faker;

$factory->define(Setting::class, function (Faker $faker) {
    return [
        '_id' => $faker->userName,
        'name' => $faker->sentence(),
        'value' => $faker->text,
        'store' => '',
        'locales' => [],
        'attributes' => [],
        'status' => $faker->randomElement([0, 1, 1, 1]),
    ];
});
