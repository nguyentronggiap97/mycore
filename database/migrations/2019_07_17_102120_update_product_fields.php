<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Modules\Store\Models\Product;

/**
 * Update product model
 */
class UpdateProductFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Remove fields
        Product::raw(function($collection) {
            return $collection->updateMany([], ['$unset' => [
                'pages' => '', 
                'format' => '', 
                'release' => '', 
                'author' => '', 
                'publisher' => '', 
                'attributes' => '', 
                'manufacturers' => '']
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
