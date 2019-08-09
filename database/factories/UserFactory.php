<?php

use App\Guid;
use App\User;
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

$factory->define(User::class, function (Faker $faker) {

    $faker->addProvider(new FakerPerson($faker));
    $faker->addProvider(new FakerProvider\vi_VN\Address($faker));
    $faker->addProvider(new FakerProvider\vi_VN\PhoneNumber($faker));

    $roles = [
        'admin', 
        'manager', 
        'publisher', 
        'sponsor', 
        'accountant',
        'school', 
        'teacher',
        'bookcase',
        'parent',
        'user',
    ];

    return [
        'pid' => '',
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember' => Str::random(10),
        'avatar' => null,
        'cover' => null,
        'gender' => $faker->randomElement(['male', 'female']),
        'mobile' => $faker->e164PhoneNumber,
        'location' => null,
        'birthday' => $faker->dateTime()->format('Y-m-d H:i:s'),
        'about' => $faker->text,
        'roles' => array_values(array_unique($faker->randomElements($roles, rand(1, 3)))),
        'status' => $faker->randomElement([0, 1, 1, 1]),
        'verified' => now()->format('Y-m-d H:i:s'),
        'updated' => now(),
        'created' => now(),
    ];
});
