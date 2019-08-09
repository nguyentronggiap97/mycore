<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\User;
use Faker\Provider as FakerProvider;
use MongoDB\BSON\UTCDateTime;
use Modules\Store\Models\Publisher;

class CreatePublisherData extends Migration
{
    /**
     * Initialize migration collection
     *
     * @return void
     */
    public function __construct()
    {
        $this->collection = (new Publisher)->getTable();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::collection($this->collection, function (Blueprint $collection) {
            foreach($this->collection() as $item) {
                // Find publisher owner by email
                $owner = User::where('email', $item['email'])->first();

                // Add publisher owner
                if ($owner) {
                    $item['uid'] = $owner->id;
                    $item['admins'][] = $owner->id;
                    $item['createdBy'] = $owner->id;
                    $item['updatedBy'] = $owner->id;
                    $item['verifiedBy'] = $owner->id;
                }

                $publisher = null;

                // Check for create publisher
                if (Publisher::where('email', $item['email'])->first() == false) {
                    $publisher = Publisher::create($item);
                }
                
                // Update user publisher id
                if ($owner && $publisher) {
                    $owner->pid = $publisher->id;
                    $owner->save();
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::collection($this->collection, function (Blueprint $collection) {
            foreach($this->collection() as $item) {
                $filter = [
                    'email' => $item['email'],
                ];

                if ($node = Publisher::where($filter)->first()) {
                    $node->forceDelete();
                }
            }
        });
    }

    public function collection()
    {
        $faker = Faker\Factory::create();
        $faker->addProvider(new FakerProvider\vi_VN\Address($faker));
        $faker->addProvider(new FakerProvider\vi_VN\PhoneNumber($faker));

        return [
            // Kim Dong
            [
                'uid' => '',
                'type' => 'publisher',
                'name' => 'NXB Kim Đồng',
                'slug' => 'nha-xuat-ban-kim-dong',
                'email' => 'kimdong@demenbook.vn',
                'phone' => $faker->e164PhoneNumber,
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'avatar' => null,
                'cover' => null,
                'assets' => [],
                'description' => $faker->text,
                'admins' => [],
                'flag' => [
                    'comment' => true,
                    'review' => true,
                    'home' => true,
                ],
                'stats' => [
                    'views' => 0,
                    'orders' => 0,
                    'revenues' => 0,
                    'discount' => 0,
                    'purchases' => 0,
                ],
                'meta' => [
                    'title' => 'NXB Kim Đồng',
                    'keywords' => 'NXB Kim Đồng',
                    'description' => 'NXB Kim Đồng',
                ],
                'status' => 1,
                'createdBy' => '',
                'createdAt' => now(),
                'updatedBy' => '',
                'updatedAt' => now(),
                'verifiedBy' => '',
                'verifiedAt' => new UTCDateTime(now()),
            ],
            // Dong A
            [
                'uid' => '',
                'type' => 'publisher',
                'name' => 'NXB Đông A',
                'slug' => 'nha-xuat-ban-dong-a',
                'email' => 'donga@demenbook.vn',
                'phone' => $faker->e164PhoneNumber,
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'avatar' => null,
                'cover' => null,
                'assets' => [],
                'description' => $faker->text,
                'admins' => [],
                'flag' => [
                    'comment' => true,
                    'review' => true,
                    'home' => true,
                ],
                'stats' => [
                    'views' => 0,
                    'orders' => 0,
                    'revenues' => 0,
                    'discount' => 0,
                    'purchases' => 0,
                ],
                'meta' => [
                    'title' => 'NXB Đông A',
                    'keywords' => 'NXB Đông A',
                    'description' => 'NXB Đông A',
                ],
                'status' => 1,
                'createdBy' => '',
                'createdAt' => now(),
                'updatedBy' => '',
                'updatedAt' => now(),
                'verifiedBy' => '',
                'verifiedAt' => new UTCDateTime(now()),
            ],
            // Nhã Nam
            [
                'uid' => '',
                'type' => 'publisher',
                'name' => 'NXB Nhã Nam',
                'slug' => 'nha-xuat-ban-nha-nam',
                'email' => 'nhanam@demenbook.vn',
                'phone' => $faker->e164PhoneNumber,
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'avatar' => null,
                'cover' => null,
                'assets' => [],
                'description' => $faker->text,
                'admins' => [],
                'flag' => [
                    'comment' => true,
                    'review' => true,
                    'home' => true,
                ],
                'stats' => [
                    'views' => 0,
                    'orders' => 0,
                    'revenues' => 0,
                    'discount' => 0,
                    'purchases' => 0,
                ],
                'meta' => [
                    'title' => 'NXB Nhã Nam',
                    'keywords' => 'NXB Nhã Nam',
                    'description' => 'NXB Nhã Nam',
                ],
                'status' => 1,
                'createdBy' => '',
                'createdAt' => now(),
                'updatedBy' => '',
                'updatedAt' => now(),
                'verifiedBy' => '',
                'verifiedAt' => new UTCDateTime(now()),
            ],
            // Phụ nữ
            [
                'uid' => '',
                'type' => 'publisher',
                'name' => 'NXB Phụ nữ',
                'slug' => 'nha-xuat-ban-phu-nu',
                'email' => 'phunu@demenbook.vn',
                'phone' => $faker->e164PhoneNumber,
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'avatar' => null,
                'cover' => null,
                'assets' => [],
                'description' => $faker->text,
                'admins' => [],
                'flag' => [
                    'comment' => true,
                    'review' => true,
                    'home' => true,
                ],
                'stats' => [
                    'views' => 0,
                    'orders' => 0,
                    'revenues' => 0,
                    'discount' => 0,
                    'purchases' => 0,
                ],
                'meta' => [
                    'title' => 'NXB Phụ nữ',
                    'keywords' => 'NXB Phụ nữ',
                    'description' => 'NXB Phụ nữ',
                ],
                'status' => 1,
                'createdBy' => '',
                'createdAt' => now(),
                'updatedBy' => '',
                'updatedAt' => now(),
                'verifiedBy' => '',
                'verifiedAt' => new UTCDateTime(now()),
            ],
            // Omega
            [
                'uid' => '',
                'type' => 'publisher',
                'name' => 'NXB Omega',
                'slug' => 'nha-xuat-ban-omega',
                'email' => 'omega@demenbook.vn',
                'phone' => $faker->e164PhoneNumber,
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'avatar' => null,
                'cover' => null,
                'assets' => [],
                'description' => $faker->text,
                'admins' => [],
                'flag' => [
                    'comment' => true,
                    'review' => true,
                    'home' => true,
                ],
                'stats' => [
                    'views' => 0,
                    'orders' => 0,
                    'revenues' => 0,
                    'discount' => 0,
                    'purchases' => 0,
                ],
                'meta' => [
                    'title' => 'NXB Omega',
                    'keywords' => 'NXB Omega',
                    'description' => 'NXB Omega',
                ],
                'status' => 1,
                'createdBy' => '',
                'createdAt' => now(),
                'updatedBy' => '',
                'updatedAt' => now(),
                'verifiedBy' => '',
                'verifiedAt' => new UTCDateTime(now()),
            ],
            // NXB Trẻ
            [
                'uid' => '',
                'type' => 'publisher',
                'name' => 'NXB Trẻ',
                'slug' => 'nha-xuat-ban-tre',
                'email' => 'nxbtre@demenbook.vn',
                'phone' => $faker->e164PhoneNumber,
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'avatar' => null,
                'cover' => null,
                'assets' => [],
                'description' => $faker->text,
                'admins' => [],
                'flag' => [
                    'comment' => true,
                    'review' => true,
                    'home' => true,
                ],
                'stats' => [
                    'views' => 0,
                    'orders' => 0,
                    'revenues' => 0,
                    'discount' => 0,
                    'purchases' => 0,
                ],
                'meta' => [
                    'title' => 'NXB Trẻ',
                    'keywords' => 'NXB Trẻ',
                    'description' => 'NXB Trẻ',
                ],
                'status' => 1,
                'createdBy' => '',
                'createdAt' => now(),
                'updatedBy' => '',
                'updatedAt' => now(),
                'verifiedBy' => '',
                'verifiedAt' => new UTCDateTime(now()),
            ],
            // NXB Long Minh
            [
                'uid' => '',
                'type' => 'publisher',
                'name' => 'NXB Long Minh',
                'slug' => 'nha-xuat-ban-long-minh',
                'email' => 'longminh@demenbook.vn',
                'phone' => $faker->e164PhoneNumber,
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'avatar' => null,
                'cover' => null,
                'assets' => [],
                'description' => $faker->text,
                'admins' => [],
                'flag' => [
                    'comment' => true,
                    'review' => true,
                    'home' => true,
                ],
                'stats' => [
                    'views' => 0,
                    'orders' => 0,
                    'revenues' => 0,
                    'discount' => 0,
                    'purchases' => 0,
                ],
                'meta' => [
                    'title' => 'NXB Long Minh',
                    'keywords' => 'NXB Long Minh',
                    'description' => 'NXB Long Minh',
                ],
                'status' => 1,
                'createdBy' => '',
                'createdAt' => now(),
                'updatedBy' => '',
                'updatedAt' => now(),
                'verifiedBy' => '',
                'verifiedAt' => new UTCDateTime(now()),
            ],
            // NXB Đông Tây
            [
                'uid' => '',
                'type' => 'publisher',
                'name' => 'NXB Đông Tây',
                'slug' => 'nha-xuat-ban-dong-tay',
                'email' => 'dongtay@demenbook.vn',
                'phone' => $faker->e164PhoneNumber,
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'avatar' => null,
                'cover' => null,
                'assets' => [],
                'description' => $faker->text,
                'admins' => [],
                'flag' => [
                    'comment' => true,
                    'review' => true,
                    'home' => true,
                ],
                'stats' => [
                    'views' => 0,
                    'orders' => 0,
                    'revenues' => 0,
                    'discount' => 0,
                    'purchases' => 0,
                ],
                'meta' => [
                    'title' => 'NXB Đông Tây',
                    'keywords' => 'NXB Đông Tây',
                    'description' => 'NXB Đông Tây',
                ],
                'status' => 1,
                'createdBy' => '',
                'createdAt' => now(),
                'updatedBy' => '',
                'updatedAt' => now(),
                'verifiedBy' => '',
                'verifiedAt' => new UTCDateTime(now()),
            ],
        ];
    }
}
