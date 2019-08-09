<?php

use Modules\Store\Models\Author;
use Illuminate\Database\Seeder;

/**
 * Command to generate seed data
 *  composer dump-autoload
 *  php artisan db:seed --class=AuthorSeeder
 */
class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Author::class, 10)->create();
    }
}
