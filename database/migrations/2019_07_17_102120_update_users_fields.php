<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\User;

/**
 * Example for migration with mongodb
 * @link(https://stackoverflow.com/a/50407173)
 * @link(https://github.com/jenssegers/laravel-mongodb/issues/1269)
 */
class UpdateUsersFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Remove field {publisher}
        User::raw(function($collection) {
            return $collection->updateMany([], ['$unset' => ['publisher' => ''] ]);
        });

        // Add field {pid}
        User::raw(function($collection) {
            return $collection->updateMany([], ['$set' => ['pid' => '', 'location' => ''] ]);
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
