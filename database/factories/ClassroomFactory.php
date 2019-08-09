<?php

use App\User;
use App\Guid;
use Modules\Bookcase\Models\School;
use Modules\Bookcase\Models\Classroom;

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

$factory->define(Classroom::class, function (Faker $faker) {

    $faker->addProvider(new FakerPerson($faker));
    $faker->addProvider(new FakerProvider\vi_VN\Address($faker));
    $faker->addProvider(new FakerProvider\vi_VN\PhoneNumber($faker));

    $user  = User::skip(rand(1, User::count() - 1))->first();
    $school = School::skip(rand(1, School::count() - 1))->first();
    $start = intval(date('Y')) - rand(0, 2);

    if (empty($user) || empty($school)) {
        return [];
    }

    $name = $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]);

    if ($name < 6) {
        $level = 1;
    } else if($name > 9) {
        $level = 3;
    } else {
        $level = 2;
    }

    $name = strval($name) . $faker->randomElement(['A', 'B', 'C', 'D', 'E']);

    return [
        'uid' => $user->id,
        'level' => $level,
        'name' => $name,
        'slug' => $faker->slug,
        'email' => $faker->email,
        'mobile' => $faker->e164PhoneNumber,
        'school' => $school->getEmbedded2(),
        'year' => [
            'start' => $start,
            'end' => $start + 3,
        ],
        'avatar' => null,
        'cover' => null,
        'assets' => [],
        'about' => $faker->text,
        'admins' => [],
        'parents' => [],
        'students' => [],
        'flag' => [],
        'stats' => [],
        'meta' => [],
        'status' => $faker->randomElement([0, 1, 1, 1, 1, 1, 1, 1, 1, 1]),
        'createdBy' => $user->id,
        'createdAt' => now(),
        'updatedBy' => $user->id,
        'updatedAt' => now(),
    ];
});
