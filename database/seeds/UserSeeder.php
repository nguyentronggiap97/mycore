<?php

use App\User;
use Illuminate\Database\Seeder;

/**
 * Command to generate seed data
 * -----------------------------
 *  composer dump-autoload
 *  php artisan db:seed --class=UserSeeder
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create();
    }
}
