<?php

namespace Modules\Menu\Models;

use App\Traits\Objectable;
use Cedu\Mongodb\Eloquent\SoftDeletes;
use App\Model as Eloquent;

class Menu extends Eloquent
{
    use SoftDeletes;
    use Objectable;

    protected $connection = 'mongodb';
    protected $collection = 'sys.menu';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    const STATUS_DRAFT      = 0;
    const STATUS_ACTIVE     = 1;

    /**
     * Config key redis
     */
    const MENU_RECURSIVE_KEY = 'redis_key_menu';
    const MENU_RECURSIVE_KEY_LIST_ALL = 'redis_key_menu_list_all';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        '_id',          // Campaign id
        'pid',          // Parent id
        'name',         // Menu name
        'link',
        'status',
        'sort',
        'created_at',    // Datetime
        'updated_at',    // Datetime
        'deleted_at',    // Datetime
    ];

    public static function getCollection($bucket = null)
    {
        $collection = [
            'status' => [
                Menu::STATUS_ACTIVE => 'Kích hoạt',
                Menu::STATUS_DRAFT => 'Ẩn',
            ],
        ];

        return $collection[$bucket] ?? $collection;
    }


    public function children() {
        return $this->hasMany(Menu::class, 'pid');
    }
    public function grandchildren()
    {
        return $this->children()->with('grandchildren');
    }

}