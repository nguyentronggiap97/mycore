<?php

namespace App\Traits;

use DB;
use MongoDB\Operation\FindOneAndUpdate;

/**
 * Add auto increment to mongodb model
 * @link(https://gist.github.com/Ademking/ef99bb8abf04afda6baabd5fc5d22659)
 * @link(https://gist.github.com/iRbouh/d244ff8ad05dbbce417a0b664d2d89a4)
 * @example $author->id = Author::getID();
 */
trait Countable
{
    /**
     * Increment the counter and get the next sequence
     * 
     * @param $collection
     * @return mixed
     */
    private static function getID($collection) {
        $seq = DB::getCollection('sys.counters')->findOneAndUpdate(
            ['_id' => $collection],
            [
                '$inc' => ['seq' => 1]
            ],
            [
                'new' => true, 
                'upsert' => true, 
                'returnDocument' => FindOneAndUpdate::RETURN_DOCUMENT_AFTER
            ]
        );
        return $seq->seq;
    }

    /**
     * Boot the AutoIncrementID trait for the model.
     *
     * @return void
     */
    public static function bootCountable() {
        static::creating(function ($model) {
            $model->incrementing = false;
            $model->{$model->getKeyName()} = self::getID($model->getTable());
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