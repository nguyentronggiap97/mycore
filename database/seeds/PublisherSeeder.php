<?php

use App\Guid;
use App\User;
use MongoDB\BSON\UTCDateTime;
use Modules\Store\Models\Publisher;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use Faker\Provider as FakerProvider;

/**
 * Command to generate seed data
 * -----------------------------
 *  composer dump-autoload
 *  php artisan db:seed --class=PublisherSeeder
 */
class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        /**
         * Generate system roles
         */
        $nodes = $this->factory($faker);

        foreach ($nodes as $item) {
            // Find publisher owner by email
            $owner = User::where('email', $item['email'])->first();

            // Add publisher owner
            if ($owner) {
                $item['owner'] = $owner->id;
                $item['admins'][] = $owner->id;
                $item['createdBy'] = $owner->id;
                $item['updatedBy'] = $owner->id;
                $item['verifiedBy'] = $owner->id;
            }

            // Check for create publisher
            $publisher = Publisher::firstOrCreate(['email' => $item['email']], $item);

            // Update user publisher id
            if ($owner) {
                $owner->pid = $publisher->id;
                $owner->publisher = $publisher->getEmbedded2();
                $owner->save();
            }
        }
    }

    public function factory(Faker $faker)
    {
        return [
            // Kim Dong
            [
                'type' => 'publisher',
                'owner' => '',
                'name' => 'NXB Kim Đồng',
                'slug' => 'nha-xuat-ban-kim-dong',
                'email' => 'kimdong@demenbook.vn',
                'phone' => $faker->e164PhoneNumber,
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'discount' => $faker->randomElement([25, 30, 35, 40, 45]),
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
                'type' => 'publisher',
                'owner' => '',
                'name' => 'NXB Đông A',
                'slug' => 'nha-xuat-ban-dong-a',
                'email' => 'donga@demenbook.vn',
                'phone' => $faker->e164PhoneNumber,
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'discount' => $faker->randomElement([25, 30, 35, 40, 45]),
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
                'type' => 'publisher',
                'owner' => '',
                'name' => 'NXB Nhã Nam',
                'slug' => 'nha-xuat-ban-nha-nam',
                'email' => 'nhanam@demenbook.vn',
                'phone' => $faker->e164PhoneNumber,
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'discount' => $faker->randomElement([25, 30, 35, 40, 45]),
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
                'type' => 'publisher',
                'owner' => '',
                'name' => 'NXB Phụ nữ',
                'slug' => 'nha-xuat-ban-phu-nu',
                'email' => 'phunu@demenbook.vn',
                'phone' => $faker->e164PhoneNumber,
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'discount' => $faker->randomElement([25, 30, 35, 40, 45]),
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
                'type' => 'publisher',
                'owner' => '',
                'name' => 'NXB Omega',
                'slug' => 'nha-xuat-ban-omega',
                'email' => 'omega@demenbook.vn',
                'phone' => $faker->e164PhoneNumber,
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'discount' => $faker->randomElement([25, 30, 35, 40, 45]),
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
                'type' => 'publisher',
                'owner' => '',
                'name' => 'NXB Trẻ',
                'slug' => 'nha-xuat-ban-tre',
                'email' => 'nxbtre@demenbook.vn',
                'phone' => $faker->e164PhoneNumber,
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'discount' => $faker->randomElement([25, 30, 35, 40, 45]),
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
                'type' => 'publisher',
                'owner' => '',
                'name' => 'NXB Long Minh',
                'slug' => 'nha-xuat-ban-long-minh',
                'email' => 'longminh@demenbook.vn',
                'phone' => $faker->e164PhoneNumber,
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'discount' => $faker->randomElement([25, 30, 35, 40, 45]),
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
                'type' => 'publisher',
                'owner' => '',
                'name' => 'NXB Đông Tây',
                'slug' => 'nha-xuat-ban-dong-tay',
                'email' => 'dongtay@demenbook.vn',
                'phone' => $faker->e164PhoneNumber,
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'discount' => $faker->randomElement([25, 30, 35, 40, 45]),
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
