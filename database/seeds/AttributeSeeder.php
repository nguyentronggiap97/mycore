<?php

use Faker\Generator as Faker;
use Faker\Provider as FakerProvider;

use Illuminate\Database\Seeder;

use Modules\Store\Models\Attribute;

/**
 * Command to generate seed data
 * -----------------------------
 *  composer dump-autoload
 *  php artisan db:seed --class=AttributeSeeder
 */
class AttributeSeeder extends Seeder
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
        $nodes = $this->attributes();

        foreach ($nodes as $item) {
            Attribute::firstOrCreate([
                'code' => $item['code'],
            ], $item);
        }
    }

    public function attributes()
    {
        return [
            [
                'code' => 'age',
                'name' => 'Độ tuổi',
                'about' => 'Độ tuổi phù hợp đọc sách',
                'type' => 'text',
                'order' => 0,
                'values' => [],
                'locales' => null,
                'validation' => 'text',
                'remote' => null,
                'required' => 0,
                'unique' => 1,
                'status' => 1
            ],
            [
                'code' => 'pages',
                'name' => 'Số trang',
                'about' => 'Tổng số trang sách',
                'type' => 'number',
                'order' => 1,
                'values' => [],
                'locales' => null,
                'validation' => 'number',
                'remote' => null,
                'required' => 0,
                'unique' => 1,
                'status' => 1
            ],
            [
                'code' => 'cover',
                'name' => 'Loại bìa',
                'about' => 'Loại bìa sách: cứng, mềm',
                'type' => 'select',
                'order' => 2,
                'values' => [ 
                    'Bìa mềm', 
                    'Bìa cứng'
                ],
                'locales' => null,
                'validation' => 'text',
                'remote' => null,
                'required' => 0,
                'unique' => 1,
                'status' => 1
            ],
            [
                'code' => 'languages',
                'name' => 'Ngôn ngữ',
                'about' => null,
                'type' => 'multiselect',
                'order' => 3,
                'values' => [],
                'locales' => null,
                'validation' => 'text',
                'remote' => '/backend/terms/search?type=lang',
                'required' => 0,
                'unique' => 1,
                'status' => 1
            ],
            [
                'code' => 'translators',
                'name' => 'Dịch giả',
                'about' => 'Danh sách người dịch sách',
                'type' => 'multiselect',
                'order' => 4,
                'values' => [],
                'locales' => null,
                'validation' => 'text',
                'remote' => '/backend/terms/search?type=translator',
                'required' => 0,
                'unique' => 1,
                'status' => 1
            ],
            [
                'code' => 'license',
                'name' => 'Nhà xuất bản',
                'about' => 'Giấy phép của nhà xuất bản',
                'type' => 'select',
                'order' => 5,
                'values' => [],
                'locales' => null,
                'validation' => 'text',
                'remote' => '/backend/terms/search?type=publisher',
                'required' => 0,
                'unique' => 1,
                'status' => 1
            ],
            [
                'code' => 'release',
                'name' => 'Ngày phát hành',
                'about' => 'Ngày phát hành sách ra thị trường',
                'type' => 'date',
                'order' => 6,
                'values' => [],
                'locales' => null,
                'validation' => 'text',
                'remote' => null,
                'required' => 0,
                'unique' => 1,
                'status' => 1,
            ],
        ];
    }
}
