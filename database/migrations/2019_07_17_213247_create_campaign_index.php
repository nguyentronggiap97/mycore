<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Modules\Campaign\Models\Campaign;

class CreateCampaignIndex extends Migration
{
    protected $indexable = [
        'pid',
        'start',
        'end',
        'categories',
        'status',
    ];

    /**
     * Initialize migration collection
     *
     * @return void
     */
    public function __construct()
    {
        $this->collection = (new Campaign)->getTable();
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
