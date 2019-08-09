<?php

use App\User;
use App\Guid;
use Modules\Bookcase\Models\Bookcase;
use Modules\Bookcase\Models\Classroom;
use Modules\Store\Models\Product;

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Faker\Provider as FakerProvider;

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

$factory->define(Bookcase::class, function (Faker $faker) {

    $faker->addProvider(new FakerPerson($faker));
    $faker->addProvider(new FakerProvider\vi_VN\Address($faker));
    $faker->addProvider(new FakerProvider\vi_VN\PhoneNumber($faker));

    $user  = User::skip(rand(1, User::count() - 1))->first();
    $product  = Product::first();
    $class = Classroom::skip(rand(1, Classroom::count() - 1))->first();
    $start = intval(date('Y')) - rand(0, 2);

    if (empty($user) || empty($class)) {
        return [];
    }

    return [
        '_id' => Guid::next(),
        'class' => $class->id,
        'name'  => $faker->name,
        'user' => [
            'id' => $user->id,
            'name' => $user->name
        ],
        'book' => [
            0 => [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
            ],
            1 => [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
            ],
            2 => [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
            ],
        ],
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
        'status' => $faker->randomElement([0, 1, 1, 1, 1, 1, 1, 1, 1, 1]),
        'verified' => now()->format('Y-m-d H:i:s'),
        'updated' => now(),
        'created' => now(),
    ];
});
