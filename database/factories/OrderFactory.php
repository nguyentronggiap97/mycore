<?php

use App\Guid;
use App\User;
use Modules\Store\Models\Order;
use Modules\Store\Models\Product;
use Modules\Store\Models\Publisher;
use Modules\Bookcase\Models\Classroom;

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

$factory->define(Order::class, function (Faker $faker) {
    $user = User::skip(rand(1, User::count() - 1))->first();
    $room = Classroom::skip(rand(1, Classroom::count() - 1))->first();
    $vendor = Publisher::skip(rand(1, Publisher::count() - 1))->first();
    
    $items = [];
    $total = 0;
    $bucket = Product::skip(rand(1, Product::count() - 1))->take(rand(1, 5))->get();

    foreach($bucket as $item) {
        $total = $total + $item->cost * (100 - $item->discount) / 100;
        $items[] = $item->getEmbedded2(['quantity' => rand(1, 3)]);
    }

    // if (empty($user) || empty($vendor) || empty($room) || empty($bucket)) {
    //     return [];
    // }

    return [
        'oid' => Guid::seq('store.order'),
        'uid' => $user->id,
        'pid' => $vendor->id,
        'bid' => $room->id,
        'total' => $total,
        'subtotal' => $total,
        'customer' => $user->getEmbedded2(),
        'publisher' => $vendor->getEmbedded2(),
        'bookcase' => $room->getEmbedded2(),
        'billing' => [],
        'shipping' => [],
        'tax' => [],
        'payment' => [],
        'notes' => [],
        'products' => $items,
        'deleted' => false,
        'status' => $faker->randomElement([0, 1, 1, 1]),
        'updated' => now(),
        'created' => now(),
    ];
});
