<?php

use App\Guid;

use Modules\Store\Models\Category;

use Faker\Generator as Faker;
use Faker\Provider as FakerProvider;

use Illuminate\Database\Seeder;

/**
 * Command to generate seed data
 * -----------------------------
 *  composer dump-autoload
 *  php artisan db:seed --class=CategorySeeder
 */
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        /**
         * Generate store category
         */
        $cates = $this->cates();

        foreach ($cates as $item) {
            Category::firstOrCreate(['name' => $item['name']], $item);
        }
    }

    public function cates()
    {
        return [
            [
                '_id' => Guid::next(),
                'type' => 'store',
                'name' => 'Lịch sử',
                'slug' => 'lich-su',
                'level' => '1',
                'about' => '',
                'avatar' => '',
                'parent' => '',
                'items' => [],
                'flag' => [],
                'stats' => [],
                'meta' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => Guid::next(),
                'type' => 'store',
                'name' => 'Truyền thống',
                'slug' => 'truyen-thong',
                'level' => '1',
                'about' => '',
                'avatar' => '',
                'parent' => '',
                'items' => [],
                'flag' => [],
                'stats' => [],
                'meta' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => Guid::next(),
                'type' => 'store',
                'name' => 'Kiến thức',
                'slug' => 'kien-thuc',
                'level' => '1',
                'about' => '',
                'avatar' => '',
                'parent' => '',
                'items' => [],
                'flag' => [],
                'stats' => [],
                'meta' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => Guid::next(),
                'type' => 'store',
                'name' => 'Khoa học',
                'slug' => 'khoa-hoc',
                'level' => '1',
                'about' => '',
                'avatar' => '',
                'parent' => '',
                'items' => [],
                'flag' => [],
                'stats' => [],
                'meta' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => Guid::next(),
                'type' => 'store',
                'name' => 'Văn học Việt Nam',
                'slug' => 'van-hoc-viet-nam',
                'level' => '1',
                'about' => '',
                'avatar' => '',
                'parent' => '',
                'items' => [],
                'flag' => [],
                'stats' => [],
                'meta' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => Guid::next(),
                'type' => 'store',
                'name' => 'Văn học nước ngoài',
                'slug' => 'van-hoc-nuoc-ngoai',
                'level' => '1',
                'about' => '',
                'avatar' => '',
                'parent' => '',
                'items' => [],
                'flag' => [],
                'stats' => [],
                'meta' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => Guid::next(),
                'type' => 'store',
                'name' => 'Truyện tranh',
                'slug' => 'truyen-tranh',
                'level' => '1',
                'about' => '',
                'avatar' => '',
                'parent' => '',
                'items' => [],
                'flag' => [],
                'stats' => [],
                'meta' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => Guid::next(),
                'type' => 'store',
                'name' => 'Manga',
                'slug' => 'manga',
                'level' => '1',
                'about' => '',
                'avatar' => '',
                'parent' => '',
                'items' => [],
                'flag' => [],
                'stats' => [],
                'meta' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => Guid::next(),
                'type' => 'store',
                'name' => 'Comic',
                'slug' => 'comic',
                'level' => '1',
                'about' => '',
                'avatar' => '',
                'parent' => '',
                'items' => [],
                'flag' => [],
                'stats' => [],
                'meta' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
        ];
    }
}
