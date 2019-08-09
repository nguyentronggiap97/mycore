<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Modules\Blog\Models\Post;

class CreateBlogIndex extends Migration
{
    protected $indexable = [
        'uid',
        'pid',
        'type',
        'slug',
        'products',
        'cates',
        'tags',
        'status',
    ];

    /**
     * Initialize migration collection
     *
     * @return void
     */
    public function __construct()
    {
        $this->collection = (new Post)->getTable();
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
