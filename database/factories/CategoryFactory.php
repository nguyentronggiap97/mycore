<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\User;
use App\Guid;
use Modules\Store\Models\Category;

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Faker\Provider as FakerProvider;

$factory->define(Category::class, function (Faker $faker) {
    $faker->addProvider(new FakerPerson($faker));
    $faker->addProvider(new FakerProvider\vi_VN\Address($faker));
    $faker->addProvider(new FakerProvider\vi_VN\PhoneNumber($faker));

    return [
        '_id' => Guid::next(),    // Snowflake guid
        'type' => $faker->randomElement([1, 2, 3]),   // String: category type (store, book, blog,...)
        'name' => $faker->sentence(),  // Total price
        'slug' => $faker->slug,
        'about' => $faker->text,
        'avatar' => [
            'width' => 320,
            'height' => 320,
            'offsetX' => 0,
            'offsetY' => 0,
            'src' => $faker->imageUrl(320,320, 'people'),
        ],
        'cover' => [
            'width' => 1280,
            'height' => 320,
            'offsetX' => 0,
            'offsetY' => 0,
            'src' => $faker->imageUrl(1280,320, 'nature'),
        ],
        'theme' => [],
        'status' => $faker->randomElement([0, 1, 1, 1, 1, 1, 1, 1, 1, 1]),
        'verified' => now()->format('Y-m-d H:i:s'),
        'updated' => now(),
        'created' => now(),
    ];

});
