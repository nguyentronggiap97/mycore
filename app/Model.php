<?php

namespace App;

use Cedu\Mongodb\Eloquent\Model as Eloquent;

use Illuminate\Contracts\Support\Arrayable;

class Model extends Eloquent
{
    /**
     * The model's default values for embeddeds response.
     *
     * @var array
     */
    protected $embeddeds = [
        '_id',
    ];

    /**
     * Get model embedded data
     * @example $user->publisher = $publisher->getEmbedded()
     */
    public function getEmbedded($merge = [])
    {
        $node = new self();
        $node->timestamps = false;

        foreach($this->embeddeds as $field) {
            // Check for {field} exists
            if (isset($this->{$field}) == false) {
                continue;
            }

            $value = $this->{$field};

            if ($value instanceof Arrayable) {
                $node->{$field} = $value->toArray();
            } else {
                $node->{$field} = $value;
            }
        }

        $node->fill($merge);
        
        return $node;
    }

    /**
     * Get model embedded data with array format
     */
    public function getEmbedded2($merge = [])
    {
        return $this->getEmbedded($merge)->toArray();
    }

    /**
     * Model helper function to find object
     */
    public function fetch($id = null)
    {
        return parent::find($id ?? $this->id);
    }
    
    /**
     * Model helper function to find or create default object
     */
    public static function findOrCreate($id)
    {
        $obj = static::find($id);
        return $obj ?: new static;
    }

    /**
     * Create empty instance from fillable and merge with data
     */
    public static function createWithFillable($merge = [])
    {
        $instance = new static;
        $fillable = $instance->getFillable();
        
        $bucket = array_fill_keys($fillable, null);
        $bucket = array_merge($bucket, $merge);

        $instance->fill($bucket);

        return $instance;
    }
}
