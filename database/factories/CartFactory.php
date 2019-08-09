<?php
/* @var $factory \Illuminate\Database\Eloquent\Factory */
use App\User;
use App\Guid;
use Modules\Store\Models\Product;
use Modules\Store\Models\Cart;
use Modules\Bookcase\Models\Classroom;
use Modules\Store\Models\Publisher;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Faker\Provider as FakerProvider;

$factory->define(Cart::class, function (Faker $faker) {
    $user = User::skip(rand(1, User::count() - 1))->first();
    $room = Classroom::skip(rand(1, Classroom::count() - 1))->first();
    $vendor = Publisher::skip(rand(1, Publisher::count() - 1))->first();

    $items = [];
    $total = 0;
    $bucket = Product::skip(rand(1, Product::count() - 1))->take(rand(1, 5))->get();

    foreach($bucket as $item) {
        $total = $total + $item->cost * (100 - $item->discount) / 100;
        $items[] = $item->getEmbedded2([
            'quantity' => rand(1, 3),
            'totalAmount' => rand(100000, 300000)
        ]);
    }
    return [
        'oid' => Guid::seq('store.cart'),
        'uid' => $user->id,
        'pid' => $vendor->id,
        'rid' => $room->id,
        'total' => $total,
        'subtotal' => $total,
        'customer' =>  [
            "id" => "985453732702609412",
            "name" => "Accountant Demo",
            "avatar" =>  [
                "width" => 320,
                "height" => 320,
                "offsetX" => 0,
                "offsetY" => 0,
                "src" => "https://lorempixel.com/320/320/people/?69777",
                ],
            ],
        'publisher' => $vendor->getEmbedded2(),
        'room' => $room->getEmbedded2(),
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
