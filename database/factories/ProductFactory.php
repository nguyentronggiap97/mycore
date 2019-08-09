<?php

use App\User;
use MongoDB\BSON\UTCDateTime;

use Modules\Store\Models\Product;
use Modules\Store\Models\Publisher;

use Faker\Generator as Faker;
use Faker\Provider as FakerProvider;

use Illuminate\Support\Str;

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

$factory->define(Product::class, function (Faker $faker) {

    $faker->addProvider(new FakerPerson($faker));
    $faker->addProvider(new FakerProvider\vi_VN\Address($faker));
    $faker->addProvider(new FakerProvider\vi_VN\PhoneNumber($faker));

    $user = User::skip(rand(1, User::count() - 1))->first();
    $publisher = Publisher::first();

    if (empty($user) || empty($publisher)) {
        return [];
    }

    $photos = [];

    for($i=0; $i<rand(5, 10); $i++) {
        $photos[] = [
            'type' => 'img',
            'width' => 680,
            'height' => 840,
            'src' => $faker->imageUrl(680, 840, 'food'),
        ];
    }

    $status = $faker->randomElement([0, 1, 1, 1, -1, -2, -3]);
    $quantity = rand(0, 1000);

    if ($status == -2) {
        $quantity = 0;
    }

    return [
        '_id' => Guid::next(),
        'uid' => $user->_id,
        'pid' => $publisher->_id,

        'sku' => $faker->ean13,
        'code' => $faker->isbn13,
        'type' => 'book',
        'name' => $faker->sentence(),
        'slug' => $faker->slug,

        'cost' => rand(50, 200) * 1000,
        'discount' => $faker->randomElement([25, 30, 35, 40, 45]),
        'expired' => $faker->randomElement([null, new UTCDateTime()]),
        'quantity' => $quantity,
        'summary' => $faker->text,
        'content' => $faker->paragraphs(6, true),
        'thumb' => [
            'width' => 320,
            'height' => 320,
            'src' => $faker->imageUrl(320,320, 'people'),
        ],
        'assets' => $photos,
        'authors' => [],
        'collection' => [],
        'categories' => [],
        'properties' => [
            'pages' => rand(200, 400),
            'format' => 'soft',
            'release' => new UTCDateTime(),
        ],
        'shipping' => [
            'width' => 130,
            'heigh' => 190,
            'weight' => 185,
        ],
        'location' => [],
        'tags' => [],
        'flag' => [
            'hot' => true,
            'new' => true,
            'comment' => true,
        ],
        'stats' => [
            'views' => rand(10000, 1000000),
            'purchases' => rand(20, 50),
        ],
        'meta' => [
            'title' => 'NXB Kim Đồng',
            'keywords' => 'NXB Kim Đồng',
            'description' => 'NXB Kim Đồng',
        ],
        'status' => $status,
        'createdBy' => $user->_id,
        'createdAt' => now(),
        'updatedBy' => $user->_id,
        'updatedAt' => now(),
        'verifiedBy' => $user->_id,
        'verifiedAt' => new UTCDateTime(now()),
    ];
});
