<?php

use App\User;
use MongoDB\BSON\UTCDateTime;

use Modules\Store\Models\Review;

use Illuminate\Support\Str;

use Faker\Generator as Faker;
use Faker\Provider as FakerProvider;
use Modules\Store\Models\Product;
use App\Guid;


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

$factory->define(Review::class, function (Faker $faker) {

    $faker->addProvider(new FakerPerson($faker));
    $faker->addProvider(new FakerProvider\vi_VN\Address($faker));
    $faker->addProvider(new FakerProvider\vi_VN\PhoneNumber($faker));

    $user = User::skip(rand(1, User::count() - 1))->first();
    $product = Product::skip(rand(1, Product::count() - 1))->first();

    if (empty($user)) {
        return [];
    }

    $arr = [1,1.5,2,2.5,3,3.5,4,4.5,5];
    $rand = rand(0, count($arr));
    $rate = $arr[$rand];

    return [
        'uid' => $user->id,
        'pid' => $product->id,
        'title' => $faker->text,
        'body' => $faker->paragraphs(6, true),
        'rating' => $rate,
        'createdBy' => $user->_id,
        'createdAt' => now(),
        'updatedBy' => $user->_id,
        'updatedAt' => now(),
    ];
});
