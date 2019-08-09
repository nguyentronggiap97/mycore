<?php

namespace Modules\Backend\Models;

use App\Model;
use App\Traits\Objectable;

/**
 * Handle batch download
 * @todo Define model field
 * @todo Pending
 */
class Download extends Model
{
    use Objectable;

    protected $connection = 'mongodb';
    protected $collection = 'sys.download';
    
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];
}