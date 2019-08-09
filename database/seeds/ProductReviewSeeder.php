<?php

use Illuminate\Database\Seeder;
use Modules\Store\Models\Review;
/**
 * Command to generate seed data
 * -----------------------------
 *  composer dump-autoload
 *  php artisan db:seed --class=ProductReviewSeeder
 */

class ProductReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Review::class, 10)->create();
    }
}
