<?php

use App\User;
use App\Role;
use App\Perm;
use App\Guid;

use Modules\Store\Models\Publisher;

use Faker\Generator as Faker;
use Faker\Provider as FakerProvider;

use Illuminate\Database\Seeder;

/**
 * Command to generate seed data
 * -----------------------------
 *  composer dump-autoload
 *  php artisan db:seed --class=RoleSeeder
 */
class RoleSeeder extends Seeder
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
        $roles = $this->roles();

        foreach ($roles as $item) {
            Role::firstOrCreate(['_id' => $item['_id']], $item);
        }

        /**
         * Generate system admin
         */
        $users = $this->users($faker);

        foreach ($users as $item) {
            if (User::where('email', $item['email'])->first() == false) {
                User::create($item);
            }
        }
    }

    public function roles()
    {
        return [
            [
                '_id' => 'admin',
                'name' => 'Admin',
                'level' => '1',
                'description' => 'Admin has all permission',
                'perms' => Perm::all(),
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => 'manager',
                'name' => 'Manager',
                'level' => '2',
                'description' => 'System management',
                'perms' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => 'publisher',
                'name' => 'Publisher',
                'level' => '3',
                'description' => 'Publisher',
                'perms' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => 'sponsor',
                'name' => 'Sponsor',
                'level' => '4',
                'description' => 'Sponsor who sponsor for Demen',
                'perms' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => 'accountant',
                'name' => 'Accountant',
                'level' => '5',
                'description' => 'Accountant',
                'perms' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => 'school',
                'name' => 'School',
                'level' => '6',
                'description' => 'School management',
                'perms' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => 'teacher',
                'name' => 'Teacher',
                'level' => '7',
                'description' => 'Teacher',
                'perms' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => 'bookcase',
                'name' => 'Bookcase',
                'level' => '8',
                'description' => 'Bookcase management',
                'perms' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => 'parent',
                'name' => 'Parent',
                'level' => '9',
                'description' => 'Parent',
                'perms' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ]
        ];
    }

    public function users($faker)
    {
        $faker->addProvider(new FakerPerson($faker));
        $faker->addProvider(new FakerProvider\vi_VN\Address($faker));
        $faker->addProvider(new FakerProvider\vi_VN\PhoneNumber($faker));

        return [
            [
                'pid' => '',
                'name' => 'Demen Admin',
                'email' => 'admin@demenbook.vn',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember' => Str::random(10),
                'avatar' => null,
                'cover' => null,
                'gender' => $faker->randomElement(['male', 'female']),
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'birthday' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'about' => $faker->text,
                'roles' => [
                    'admin',
                ],
                'status' => 1,
                'verified' => now()->format('Y-m-d H:i:s'),
                'updated' => now(),
                'created' => now(),
            ],
            [
                'pid' => '',
                'name' => 'Demen Manager',
                'email' => 'manager@demenbook.vn',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember' => Str::random(10),
                'avatar' => null,
                'cover' => null,
                'gender' => $faker->randomElement(['male', 'female']),
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'birthday' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'about' => $faker->text,
                'roles' => [
                    'manager',
                ],
                'status' => 1,
                'verified' => now()->format('Y-m-d H:i:s'),
                'updated' => now(),
                'created' => now(),
            ],
            // Publisher
            [
                'pid' => '',
                'name' => 'Kim Dong Manager',
                'email' => 'kimdong@demenbook.vn',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember' => Str::random(10),
                'avatar' => null,
                'cover' => null,
                'gender' => $faker->randomElement(['male', 'female']),
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'birthday' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'about' => $faker->text,
                'roles' => [
                    'publisher',
                ],
                'status' => 1,
                'verified' => now()->format('Y-m-d H:i:s'),
                'updated' => now(),
                'created' => now(),
            ],
            [
                'pid' => '',
                'name' => 'Đông A Manager',
                'email' => 'donga@demenbook.vn',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember' => Str::random(10),
                'avatar' => null,
                'cover' => null,
                'gender' => $faker->randomElement(['male', 'female']),
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'birthday' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'about' => $faker->text,
                'roles' => [
                    'publisher',
                ],
                'status' => 1,
                'verified' => now()->format('Y-m-d H:i:s'),
                'updated' => now(),
                'created' => now(),
            ],
            [
                'pid' => '',
                'name' => 'Nhã Nam Manager',
                'email' => 'nhanam@demenbook.vn',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember' => Str::random(10),
                'avatar' => null,
                'cover' => null,
                'gender' => $faker->randomElement(['male', 'female']),
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'birthday' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'about' => $faker->text,
                'roles' => [
                    'publisher',
                ],
                'status' => 1,
                'verified' => now()->format('Y-m-d H:i:s'),
                'updated' => now(),
                'created' => now(),
            ],
            [
                'pid' => '',
                'name' => 'Phụ Nữ Manager',
                'email' => 'phunu@demenbook.vn',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember' => Str::random(10),
                'avatar' => null,
                'cover' => null,
                'gender' => $faker->randomElement(['male', 'female']),
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'birthday' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'about' => $faker->text,
                'roles' => [
                    'publisher',
                ],
                'status' => 1,
                'verified' => now()->format('Y-m-d H:i:s'),
                'updated' => now(),
                'created' => now(),
            ],
            [
                'pid' => '',
                'name' => 'Omega Manager',
                'email' => 'omega@demenbook.vn',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember' => Str::random(10),
                'avatar' => null,
                'cover' => null,
                'gender' => $faker->randomElement(['male', 'female']),
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'birthday' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'about' => $faker->text,
                'roles' => [
                    'publisher',
                ],
                'status' => 1,
                'verified' => now()->format('Y-m-d H:i:s'),
                'updated' => now(),
                'created' => now(),
            ],
            [
                'pid' => '',
                'name' => 'NXB Trẻ Manager',
                'email' => 'nxbtre@demenbook.vn',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember' => Str::random(10),
                'avatar' => null,
                'cover' => null,
                'gender' => $faker->randomElement(['male', 'female']),
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'birthday' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'about' => $faker->text,
                'roles' => [
                    'publisher',
                ],
                'status' => 1,
                'verified' => now()->format('Y-m-d H:i:s'),
                'updated' => now(),
                'created' => now(),
            ],
            [
                'pid' => '',
                'name' => 'Long Minh Manager',
                'email' => 'longminh@demenbook.vn',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember' => Str::random(10),
                'avatar' => null,
                'cover' => null,
                'gender' => $faker->randomElement(['male', 'female']),
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'birthday' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'about' => $faker->text,
                'roles' => [
                    'publisher',
                ],
                'status' => 1,
                'verified' => now()->format('Y-m-d H:i:s'),
                'updated' => now(),
                'created' => now(),
            ],
            [
                'pid' => '',
                'name' => 'Đông Tây Manager',
                'email' => 'dongtay@demenbook.vn',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember' => Str::random(10),
                'avatar' => null,
                'cover' => null,
                'gender' => $faker->randomElement(['male', 'female']),
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'birthday' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'about' => $faker->text,
                'roles' => [
                    'publisher',
                ],
                'status' => 1,
                'verified' => now()->format('Y-m-d H:i:s'),
                'updated' => now(),
                'created' => now(),
            ],
            // Sponsor
            [
                'pid' => '',
                'name' => 'Sponsor Demo',
                'email' => 'sponsor@demenbook.vn',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember' => Str::random(10),
                'avatar' => null,
                'cover' => null,
                'gender' => $faker->randomElement(['male', 'female']),
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'birthday' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'about' => $faker->text,
                'roles' => [
                    'sponsor',
                ],
                'status' => 1,
                'verified' => now()->format('Y-m-d H:i:s'),
                'updated' => now(),
                'created' => now(),
            ],
            [
                'pid' => '',
                'name' => 'School Demo',
                'email' => 'school@demenbook.vn',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember' => Str::random(10),
                'avatar' => null,
                'cover' => null,
                'gender' => $faker->randomElement(['male', 'female']),
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'birthday' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'about' => $faker->text,
                'roles' => [
                    'school',
                ],
                'status' => 1,
                'verified' => now()->format('Y-m-d H:i:s'),
                'updated' => now(),
                'created' => now(),
            ],
            [
                'pid' => '',
                'name' => 'Teacher Demo',
                'email' => 'teacher@demenbook.vn',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember' => Str::random(10),
                'avatar' => null,
                'cover' => null,
                'gender' => $faker->randomElement(['male', 'female']),
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'birthday' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'about' => $faker->text,
                'roles' => [
                    'teacher',
                ],
                'status' => 1,
                'verified' => now()->format('Y-m-d H:i:s'),
                'updated' => now(),
                'created' => now(),
            ],
            [
                'pid' => '',
                'name' => 'Bookcase Demo',
                'email' => 'bookcase@demenbook.vn',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember' => Str::random(10),
                'avatar' => null,
                'cover' => null,
                'gender' => $faker->randomElement(['male', 'female']),
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'birthday' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'about' => $faker->text,
                'roles' => [
                    'bookcase',
                ],
                'status' => 1,
                'verified' => now()->format('Y-m-d H:i:s'),
                'updated' => now(),
                'created' => now(),
            ],
            [
                'pid' => '',
                'name' => 'Parent Demo',
                'email' => 'parent@demenbook.vn',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember' => Str::random(10),
                'avatar' => null,
                'cover' => null,
                'gender' => $faker->randomElement(['male', 'female']),
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'birthday' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'about' => $faker->text,
                'roles' => [
                    'parent',
                ],
                'status' => 1,
                'verified' => now()->format('Y-m-d H:i:s'),
                'updated' => now(),
                'created' => now(),
            ],
            [
                'pid' => '',
                'name' => 'Accountant Demo',
                'email' => 'accountant@demenbook.vn',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember' => Str::random(10),
                'avatar' => null,
                'cover' => null,
                'gender' => $faker->randomElement(['male', 'female']),
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'birthday' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'about' => $faker->text,
                'roles' => [
                    'accountant',
                ],
                'status' => 1,
                'verified' => now()->format('Y-m-d H:i:s'),
                'updated' => now(),
                'created' => now(),
            ],
            [
                'pid' => '',
                'name' => 'demo',
                'email' => 'user@demenbook.vn',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember' => Str::random(10),
                'avatar' => null,
                'cover' => null,
                'gender' => $faker->randomElement(['male', 'female']),
                'mobile' => $faker->e164PhoneNumber,
                'location' => null,
                'birthday' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'about' => $faker->text,
                'roles' => [
                    'user'
                ],
                'status' => 1,
                'verified' => now()->format('Y-m-d H:i:s'),
                'updated' => now(),
                'created' => now(),
            ],
        ];
    }
}
