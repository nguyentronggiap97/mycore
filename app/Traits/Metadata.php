<?php

namespace App\Traits;

/**
 * Add method to get avatar link
 * @example $obj->metaTitle
 * @example $obj->metaKeywords
 * @example $obj->metaDescription
 */
trait Metadata 
{
    /**
     * Get metadata title
     * @example $node->metaTitle
     * @return string
     */
    public function getMetaTitleAttribute()
    {
        return $this->meta['title'] ?? '';
    }

    /**
     * Get metadata keywords
     * @example $node->metaKeywords
     * @return string
     */
    public function getMetaKeywordsAttribute()
    {
        return $this->meta['keywords'] ?? '';
    }

    /**
     * Get metadata description
     * @example $node->metaDescription
     * @return string
     */
    public function getMetaDescriptionAttribute()
    {
        return $this->meta['description'] ?? '';
    }
}