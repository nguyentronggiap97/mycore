<?php

namespace App;

use DB;
use MongoDB\Operation\FindOneAndUpdate;

class Guid
{
    /**
     * Generates next guid with snowflake format
     * @example Guid::next()
     * @var null
     * @return mixed
     */
    public static function next()
    {
        return resolve('guid')->generate();
    }

    /**
     * Increment the counter and get the next sequence
     * 
     * @example Guid::seq()
     * @param $collection
     * @return mixed
     */
    public static function seq($collection) {
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
}