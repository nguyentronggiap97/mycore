<?php

use App\Setting;

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @link(Seeder, https://laravel.com/docs/5.8/seeding#calling-additional-seeders)
     * @link(Factory, https://medium.com/@jurgenbosch/laravel-advanced-database-seeding-51c475707d92)
     * @link(Args, )
     * @return void
     */
    public function run(Faker $faker)
    {
        factory(Setting::class, 10)->create();
    }
}
