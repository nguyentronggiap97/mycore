<?php

use Modules\Bookcase\Models\School;
use Illuminate\Database\Seeder;

/**
 * Command to generate seed data
 *  composer dump-autoload
 *  php artisan db:seed --class=SchoolSeeder
 */
class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(School::class, 10)->create();
    }
}
