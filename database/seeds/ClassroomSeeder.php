<?php

use Modules\Bookcase\Models\Classroom;
use Illuminate\Database\Seeder;

/**
 * Command to generate seed data
 *  composer dump-autoload
 *  php artisan db:seed --class=ClassroomSeeder
 */
class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Classroom::class, 10)->create();
    }
}
