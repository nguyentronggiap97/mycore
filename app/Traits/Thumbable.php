<?php

namespace App\Traits;

/**
 * Add method to get avatar link
 * @example $obj->thumbImage
 * @example $obj->thumbLink
 * @example $obj->thumbCache
 */
trait Thumbable
{
    /**
     * Add embedded media thumb object
     * @example $product->thumb->thumb
     * @example $product->thumb->link
     */
    public function thumb()
    {
        return $this->embedsOne('Modules\Media\Models\Media');
    }
}