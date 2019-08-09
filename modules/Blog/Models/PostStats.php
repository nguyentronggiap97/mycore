<?php

namespace Modules\Blog\Models;

use App\Model;

class PostStats extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'views',    // number   Product total views
    ];
}