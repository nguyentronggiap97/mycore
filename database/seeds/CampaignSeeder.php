<?php

use Modules\Campaign\Models\Campaign;
use Illuminate\Database\Seeder;

/**
 * Command to generate seed data
 * -----------------------------
 *  composer dump-autoload
 *  php artisan db:seed --class=CampaignSeeder
 */
class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Campaign::class, 2)->create();
    }
}
