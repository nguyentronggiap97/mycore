<?php

namespace App\Traits;

use MongoDB\BSON\ObjectId;

/**
 * Add use mongo object id in string mode
 */
trait Objectable
{
    /**
     * Increment the counter and get the next sequence
     * 
     * @param $collection
     * @return mixed
     */
    public static function ObjectId() {
        return strval(new ObjectId());
    }

    /**
     * Boot the AutoIncrementID trait for the model.
     *
     * @return void
     */
    public static function bootObjectable() {
        static::creating(function ($model) {
            $model->incrementing = false;
            $model->{$model->getKeyName()} = self::ObjectId();
        });
    }

    /**
     * Get the casts array.
     *
     * @return array
     */
    public function getCasts() {
        return $this->casts;
    }
}