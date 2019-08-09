<?php

use Modules\Store\Models\Tag;
use Illuminate\Database\Seeder;

/**
 * Command to generate seed data
 *  composer dump-autoload
 *  php artisan db:seed --class=TagSeeder
 */
class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Tag::class, 5)->create();
    }
}
