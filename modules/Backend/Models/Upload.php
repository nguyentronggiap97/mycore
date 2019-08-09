<?php

namespace Modules\Backend\Models;

use Auth;
use App\Model;
use App\Traits\Objectable;
use Illuminate\Support\Str;

class Upload extends Model
{
    use Objectable;

    protected $connection = 'mongodb';
    protected $collection = 'sys.upload';
    
    /**
     * Define user status value
     */
    const STATUS_ERROR      = -2;
    const STATUS_DELETED    = -1;
    const STATUS_PENDING    = 0;
    const STATUS_DONE       = 1;

    /**
     * Define timestamps
     */
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        '_id',      // string   Upload object id
        'uid',      // string   Upload user id
        'type',     // string   Upload type: product, school, ...
        'name',     // string   File name
        'disk',     // string   Update store to disk
        'path',     // string   File save path: relation
        'ext',      // string   File extension: jpg, pdf, ...
        'size',     // number   File size
        'batch',    // string   Process batch id
        'error',    // string   File error message
        'status',   // number   Process status
        'created',
        'updated'
    ];

    /**
     * Create new upload from file and fillable data
     * @param   $fillable = ['disk' => 'publisher', 'path' => $path];
     * @example $uploader = Upload::make($file, $fillable)->save();
     */
    public static function make($fillable)
    {
        // Get file information
        $fields = [
            'uid' => Auth::user()->id,
            'status' => static::STATUS_PENDING,
            'created' => now(),
            'updated' => now(),
        ];

        // Create & merge data
        $upload = new static;
        $values = array_fill_keys($upload->getFillable(), null);
        $bucket = array_merge($values, $fields, $fillable);
        $upload->fill($bucket);

        return $upload;
    }
}