<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Faker\Provider as FakerProvider;

use App\User;

class CreateUsersData extends Migration
{
    /**
     * Initialize migration collection
     *
     * @return void
     */
    public function __construct()
    {
        $this->collection = (new User)->getTable();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::collection($this->collection, function (Blueprint $collection) {
            foreach($this->users() as $item) {
                if (User::where('email', $item['email'])->first() == false) {
                    User::create($item);
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
            foreach($this->users() as $item) {
                if ($user = User::where('email', $item['email'])->first()) {
                    $user->forceDelete();
                }
            }
        });
    }

    public function users()
    {
        $faker = Faker\Factory::create();
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
