<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Modules\AdSense\Models\Adsense;

class CreateAdsenseIndex extends Migration
{
    protected $indexable = [
        'uid',
        'pid',
        'type',
        'cates',
        'banners',
        'status',
    ];

    /**
     * Initialize migration collection
     *
     * @return void
     */
    public function __construct()
    {
        $this->collection = (new Adsense)->getTable();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::collection($this->collection, function (Blueprint $collection) {
            foreach($this->indexable as $field) {
                $collection->index($field);
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
            foreach($this->indexable as $field) {
                $collection->dropIndex([$field]);
            }
        });
    }
}
