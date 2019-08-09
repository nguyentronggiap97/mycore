<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\User;
use App\Role;
use App\Perm;

class CreateRoleData extends Migration
{
    /**
     * Initialize migration collection
     *
     * @return void
     */
    public function __construct()
    {
        $this->collection = (new Role)->getTable();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::collection($this->collection, function (Blueprint $collection) {
            foreach($this->roles() as $item) {
                if (Role::find($item['_id']) == false) {
                    Role::create($item);
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
            foreach($this->roles() as $item) {
                if ($role = Role::find($item['_id'])) {
                    $role->forceDelete();
                }
            }
        });
    }

    public function roles()
    {
        return [
            [
                '_id' => 'admin',
                'name' => 'Admin',
                'level' => '1',
                'description' => 'Admin has all permission',
                'perms' => Perm::all(),
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => 'manager',
                'name' => 'Manager',
                'level' => '2',
                'description' => 'System management',
                'perms' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => 'publisher',
                'name' => 'Publisher',
                'level' => '3',
                'description' => 'Publisher',
                'perms' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => 'sponsor',
                'name' => 'Sponsor',
                'level' => '4',
                'description' => 'Sponsor who sponsor for Demen',
                'perms' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => 'accountant',
                'name' => 'Accountant',
                'level' => '5',
                'description' => 'Accountant',
                'perms' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => 'school',
                'name' => 'School',
                'level' => '6',
                'description' => 'School management',
                'perms' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => 'teacher',
                'name' => 'Teacher',
                'level' => '7',
                'description' => 'Teacher',
                'perms' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => 'bookcase',
                'name' => 'Bookcase',
                'level' => '8',
                'description' => 'Bookcase management',
                'perms' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ],
            [
                '_id' => 'parent',
                'name' => 'Parent',
                'level' => '9',
                'description' => 'Parent',
                'perms' => [],
                'status' => '1',
                'created' => now(),
                'updated' => now(),
            ]
        ];
    }
}
