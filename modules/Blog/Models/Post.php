<?php

namespace Modules\Blog\Models;

use App\User;
use App\Model;
use App\Traits\Castable;
use App\Traits\Guidable;
use App\Traits\Metadata;
use App\Traits\Thumbable;

use Modules\Blog\Traits\PostEvent;
use Modules\Blog\Traits\PostAttribute;
use Modules\Store\Models\Product;

use Cedu\Mongodb\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    use Guidable, Castable;
    use Metadata, Thumbable;
    use PostEvent, PostAttribute;

    protected $connection = 'mongodb';
    protected $collection = 'sys.blog';
    
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';

    const STATUS_TRASH  = -1;
    const STATUS_DRAFT  = 0;
    const STATUS_ACTIVE = 1;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'integer',

        'flag.new'      => 'boolean',
        'flag.hot'      => 'boolean',
        'flag.cover'    => 'boolean',
        'flag.comment'  => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        '_id',          // string   Snowflake auto id
        'uid',          // string   Author id, who create this post
        'pid',          // string   Product id, which in this post
        'type',         // string   Post type: blog, page, ...
        'title',        // string   Post title
        'slug',         // string   Post slug for SEO
        'thumb',        // object   Post thumb media object {path}
        'summary',      // string   Post short description
        'content',      // string   Post full content
        'products',     // array    List products id related with this post
        'cates',        // array    Post list cates id [1,2,3]
        'tags',         // array    Post list tags value ['a', 'b']
        'stats',        // object   Post stats data {comments, views, ...}
        'flag',         // object   Post flag {hot, new, review, cover, comment}
        'meta',         // object   Post meta data {title, keywrods, description}
        'status',       // number   Post status
        'created',      // Datetime
        'updated',      // Datetime
        'deleted',      // Datetime
    ];

    /**
     * Get post author data
     * @param $post->author->id
     * @param $post->author->name
     */
    public function author()
    {
        return $this->hasOne(User::class, '_id', 'uid');
    }

    /**
     * Get post product data
     * @param $post->product->id
     * @param $post->product->name
     */
    public function product()
    {
        return $this->hasOne(Product::class, '_id', 'pid');
    }

    /**
     * Add embedded attribute array
     *
     * @example $node->flag
     */
    public function flag()
    {
        return $this->embedsOne(PostFlag::class);
    }

    /**
     * Add embedded attribute array
     *
     * @example $node->stats
     */
    public function stats()
    {
        return $this->embedsOne(PostStats::class);
    }

    /**
     * Add embedded attribute array
     *
     * @example $user->meta
     */
    public function meta()
    {
        return $this->embedsOne('Modules\Store\Models\Metadata');
    }

    /**
     * Get model define dataset
     */
    public static function getDataset($set = null)
    {
        $dataset = [
            'status' => [
                static::STATUS_TRASH => 'Trash',
                static::STATUS_DRAFT => 'Draft',
                static::STATUS_ACTIVE => 'Published',
            ],
            'colors' => [
                static::STATUS_TRASH => 'danger',
                static::STATUS_DRAFT => 'warning',
                static::STATUS_ACTIVE => 'success',
            ],
        ];

        return $dataset[$set] ?? $dataset;
    }

}