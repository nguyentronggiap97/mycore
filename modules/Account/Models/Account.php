<?php

namespace Modules\Account\Models;

use App\Model as Eloquent;

class Account extends Eloquent
{
	protected $connection = 'mongodb';
    protected $collection = 'accounts';
    
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        '_id', 'name', 'detail'
    ];
}