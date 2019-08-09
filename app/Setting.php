<?php

namespace App;

use Cedu\Mongodb\Eloquent\Model as Eloquent;

class Setting extends Eloquent
{
	protected $connection = 'mongodb';
    protected $collection = 'sys.setting';
    
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        '_id',          // string   setting id
        'name',         // string   setting name
        'value',        // string   setting value
        'store',        // string   setting store id
        'locales',      // array    setting locales
        'attributes',   // array    setting attributes
        'status',       // int      setting status 0=disable, 1=enable
        'created',
        'updated',
    ];
}