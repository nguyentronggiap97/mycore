<?php

namespace Modules\Blog\Traits;

use Modules\Store\Models\Product;

trait PostAttribute
{
    /**
     * Get list relations product
     * @param $post->products->id
     * @param $post->products->name
     */
    public function getProductsAttribute()
    {
        return Product::whereIn('_id', $this->attributes['products'])->get(['name']);
    }

    /**
     * Add custom attribute to get publisher or create new instance
     * @example $product->authorText
     * @return object
     */
    public function getAuthorTextAttribute()
    {
        return $this->author ?? '';
    }
}
