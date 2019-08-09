<?php

use Modules\Store\Models\Tag;

use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Tag::class, function (Faker $faker) {
    // Random a tag with faker
    $tag = $faker->unique()->sentence(rand(1, 2));
    // Generat slug from tag
    $slug = Str::slug($tag);
    return [
        'name' => $tag,
        'slug' => $slug,
        'count' => -1,
        'status' => $faker->randomElement([0, 1, 1, 1, 1, 1, 1, 1, 1, 1]),
        'updated' => now(),
        'created' => now(),
    ];
});
