<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 6/25/19
 * Time: 14:41
 */
use Illuminate\Database\Seeder;
use Modules\Store\Models\Cart;
/**
 * Command to generate seed data
 *  composer dump-autoload
 *  php artisan db:seed --class=CartSeeder
 */
class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Cart::class, 10)->create();
    }
}