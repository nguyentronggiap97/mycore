<?php

namespace App\Traits;

/**
 * Add method to get avatar link
 * @example $obj->avatarImage
 * @example $obj->avatarLink
 * @example $obj->avatarCache
 * @example $obj->avatarThumb
 */
trait Avatarable
{
    /**
     * Add embedded media avatar object
     * @example $user->avatar->thumb
     * @example $user->avatar->link
     */
    public function avatar()
    {
        return $this->embedsOne('Modules\Media\Models\Media');
    }
}