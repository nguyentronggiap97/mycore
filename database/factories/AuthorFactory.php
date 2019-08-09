<?php

use App\User;
use App\Guid;
use Modules\Bookcase\Models\School;
use Modules\Store\Models\Author;

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

$factory->define(Author::class, function (Faker $faker) {

    $faker->addProvider(new FakerPerson($faker));
    $faker->addProvider(new FakerProvider\vi_VN\Address($faker));
    $faker->addProvider(new FakerProvider\vi_VN\PhoneNumber($faker));

    $user  = User::skip(rand(1, User::count() - 1))->first();

    if (empty($user)) {
        return [];
    }

    $name = $faker->name;

    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'email' => $faker->email,
        'phone' => $faker->e164PhoneNumber,
        'mobile' => $faker->e164PhoneNumber,
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
        'about' => $faker->text,
        'address' => [
            'city' => $faker->city,
            'stress' => $faker->streetAddress,
        ],
        'books' => [],
        'status' => $faker->randomElement([0, 1, 1, 1, 1, 1, 1, 1, 1, 1]),
        'createdAt' => now(),
        'createdBy' => $user->id,
        'updatedAt' => now(),
    ];
});
