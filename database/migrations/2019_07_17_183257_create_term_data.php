<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Modules\Backend\Models\Term;

class CreateTermData extends Migration
{
    /**
     * Initialize migration collection
     *
     * @return void
     */
    public function __construct()
    {
        $this->collection = (new Term)->getTable();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::collection($this->collection, function (Blueprint $collection) {
            foreach($this->terms() as $item) {
                $filter = [
                    'type' => $item['type'], 
                    'name' => $item['name']
                ];

                if (Term::where($filter)->first() == false) {
                    Term::create($item);
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::collection($this->collection, function (Blueprint $collection) {
            foreach($this->terms() as $item) {
                $filter = [
                    'type' => $item['type'], 
                    'name' => $item['name']
                ];

                if ($user = Term::where($filter)->first()) {
                    $user->forceDelete();
                }
            }
        });
    }

    protected function terms()
    {
        return [
            [
                "type" => "lang",
                "name" => "Tiếng Việt",
                "slug" => "tieng-viet",
                "about" => "",
                "search" => "tiếng việt, tieng viet",
                "status" => 1,
                "updated" => now(),
                "created" => now(),
            ],
            [
                "type" => "lang",
                "name" => "English",
                "slug" => "english",
                "about" => "",
                "search" => "tiếng anh, tieng anh, english",
                "status" => 1,
                "updated" => now(),
                "created" => now(),
            ],
            [
                "type" => "publisher",
                "name" => "Kim Đồng",
                "slug" => "kim-dong",
                "about" => "",
                "search" => "kim đồng, kim dong",
                "status" => 1,
                "updated" => now(),
                "created" => now(),
            ],
            [
                "type" => "publisher",
                "name" => "Đông A",
                "slug" => "dong-a",
                "about" => "",
                "search" => "đông a, dong a",
                "status" => 1,
                "updated" => now(),
                "created" => now(),
            ],
            [
                "type" => "publisher",
                "name" => "Nhã Nam",
                "slug" => "nha-nam",
                "about" => "",
                "search" => "nhã nam, nha nam",
                "status" => 1,
                "updated" => now(),
                "created" => now(),
            ],
            [
                "type" => "publisher",
                "name" => "Phụ nữ",
                "slug" => "phu-nu",
                "about" => "",
                "search" => "phụ nữ, phu nu",
                "status" => 1,
                "updated" => now(),
                "created" => now(),
            ],
            [
                "type" => "publisher",
                "name" => "Omega",
                "slug" => "omega",
                "about" => "",
                "search" => "omega, omega",
                "status" => 1,
                "updated" => now(),
                "created" => now(),
            ],
            [
                "type" => "publisher",
                "name" => "Nhà xuất bản Trẻ",
                "slug" => "nha-xuat-ban-tre",
                "about" => "",
                "search" => "nhà xuất bản trẻ, nha xuat ban tre",
                "status" => 1,
                "updated" => now(),
                "created" => now(),
            ],
            [
                "type" => "publisher",
                "name" => "Long Minh",
                "slug" => "long-minh",
                "about" => "",
                "search" => "long minh, long minh",
                "status" => 1,
                "updated" => now(),
                "created" => now(),
            ],
            [
                "type" => "publisher",
                "name" => "Đông Tây",
                "slug" => "dong-tay",
                "about" => "",
                "search" => "đông tây, dong tay",
                "status" => 1,
                "updated" => now(),
                "created" => now(),
            ]
        ];
    }
}
