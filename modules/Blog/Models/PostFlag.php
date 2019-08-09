<?php

namespace Modules\Blog\Models;

use App\Model;

class PostFlag extends Model
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
        'hot',      // number   Mark as hot book
        'new',      // number   Mark as new book
        'cover',    // number   Allow show cover image
        'comment',  // number   Allow comment
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'hot' => 'boolean',
        'new'  => 'boolean',
        'cover' => 'boolean',
        'comment' => 'boolean',
    ];

    /**
     * Calculate customer pay money
     * @example $product->flag->get('hot')
     * @example $product->flag->get('new')
     * @example $product->flag->get('cover')
     * @example $product->flag->get('comment')
     * @return string
     */
    public function get($name)
    {
        return $this->attributes[$name] ?? false;
    }
}