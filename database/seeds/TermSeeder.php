<?php

use Faker\Generator as Faker;
use Faker\Provider as FakerProvider;

use Illuminate\Database\Seeder;

use Modules\Backend\Models\Term;

/**
 * Command to generate seed data
 * -----------------------------
 *  composer dump-autoload
 *  php artisan db:seed --class=TermSeeder
 */
class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        /**
         * Generate languages data
         */
        $nodes = $this->languages();

        foreach ($nodes as $item) {
            Term::firstOrCreate([
                'type' => $item['type'],
                'name' => $item['name'],
            ], $item);
        }

        /**
         * Generate publishers data
         */
        $nodes = $this->publishers();

        foreach ($nodes as $item) {
            Term::firstOrCreate([
                'type' => $item['type'],
                'name' => $item['name'],
            ], $item);
        }
    }

    public function languages()
    {
        return [
            [
                'type' => 'lang',
                'name' => 'Tiếng Việt',
                'slug' => 'tieng-viet',
                'about' => '',
                'search' => 'tiếng việt, tieng viet',
                'status' => 1,
            ],
            [
                'type' => 'lang',
                'name' => 'English',
                'slug' => 'english',
                'about' => '',
                'search' => 'tiếng anh, tieng anh, english',
                'status' => 1,
            ],
        ];
    }

    public function publishers()
    {
        return [

        ];
    }
}
