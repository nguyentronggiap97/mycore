<?php

use Modules\Bookcase\Models\Bookcase;
use Illuminate\Database\Seeder;

/**
 * Command to generate seed data
 *  composer dump-autoload
 *  php artisan db:seed --class=BookcaseSeeder
 */
class BookcaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Bookcase::class, 100)->create();
    }
}
