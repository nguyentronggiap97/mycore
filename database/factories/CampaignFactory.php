<?php

use App\User;
use MongoDB\BSON\UTCDateTime;

use Modules\Campaign\Models\Campaign;
use Modules\Store\Models\Product;
use Modules\Store\Models\Publisher;
use Modules\Store\Models\Category;

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

$factory->define(Campaign::class, function (Faker $faker) {
    $user = User::skip(rand(1, User::count() - 1))->first();
    $pub  = Publisher::first();

    $products = [];
    $bucket = Product::skip(rand(1, Product::count() - 1))->take(rand(1, 2))->get();

    foreach($bucket as $item) {
        $products[] = $item->id;
    }

    $cates = [];
    $bucket = Category::skip(rand(1, Product::count() - 1))->take(rand(1, 2))->get();

    foreach($bucket as $item) {
        $cates[] = $item->id;
    }

    return [
        'pid' => $pub->id,
        'name' => $faker->name,
        'products' => $products,
        'position' => 'home' . $faker->randomElement([1, 2, 3, 4]),
        'categories' => $cates,
        'status' => $faker->randomElement([0, 1, 1, 1]),
        'createdBy' => $user->_id,
        'createdAt' => now(),
        'updatedBy' => $user->_id,
        'updatedAt' => now(),
        'verifiedBy' => $user->_id,
        'verifiedAt' => new UTCDateTime(now()),
    ];
});
