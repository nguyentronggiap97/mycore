<?php

namespace App\Traits;

/**
 * Add method to get thumb image
 * @example $obj->coverLink
 * @example $obj->coverImage
 * @example $obj->coverThumb
 * @example $obj->coverCache
 */
trait Coverable
{
    /**
     * Add embedded media cover object
     * @example $user->cover->thumb
     * @example $user->cover->link
     */
    public function cover()
    {
        return $this->embedsOne('Modules\Media\Models\Media');
    }
}