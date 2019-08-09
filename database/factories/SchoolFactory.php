<?php

use App\User;
use MongoDB\BSON\UTCDateTime;

use Modules\Bookcase\Models\School;

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

$factory->define(School::class, function (Faker $faker) {

    $faker->addProvider(new FakerPerson($faker));
    $faker->addProvider(new FakerProvider\vi_VN\Address($faker));
    $faker->addProvider(new FakerProvider\vi_VN\PhoneNumber($faker));

    $user = User::skip(rand(1, User::count() - 1))->first();

    if (empty($user)) {
        return [];
    }

    return [
        'name' => $faker->name,
        'slug' => $faker->slug,
        'email' => $faker->email,
        'phone' => $faker->e164PhoneNumber,
        'mobile' => $faker->e164PhoneNumber,
        'avatar' => null,
        'cover' => null,
        'level' => $faker->randomElement([1, 2, 3]),
        'about' => $faker->text,
        'location' => null,

        'admins' => [],
        'flag' => [],
        'stats' => [],
        'meta' => [],

        'status' => $faker->randomElement([0, 1, 1, 1, 1, 1, 1, 1, 1, 1]),

        'createdBy' => $user->_id,
        'createdAt' => now(),
        'updatedBy' => $user->_id,
        'updatedAt' => now(),
        'verifiedBy' => $user->_id,
        'verifiedAt' => new UTCDateTime(now()),
    ];
});
