<?php

namespace Modules\Media;

use View;
use Exception;

/**
 * Empty image when not found here
 */
class Media
{
    /**
     * Load media resources
     */
    protected $loaded = false;

    /**
     * Generate a media upload widget
     * 
     * @example Media::widget('button', ['vendor' => '1234'])
     * @example @upload('button', ['vendor' => '1234'])
     * 
     * @param $mode button|wide
     * @param $data Data to generate button ['vendor' => '']
     * @return string widget html content
     */
    public function widget($data = [])
    {
        /**
         * Add widget resource loaded status
         */
        $data['loaded'] = $this->loaded;
        $data['uid']    = $data['uid'] ?? '';
        $data['type']   = $data['type'] ?? 'image';
        $data['name']   = $data['name'] ?? 'image';
        $data['thumb']  = $data['thumb'] ?? '';
        $data['value']  = $data['value'] ?? '';
        $data['vendor'] = $data['vendor'] ?? 'default';
        $data['format'] = $data['format'] ?? 'image';
        $data['text']   = $data['text'] ?? 'Upload';

        $data['encode'] = [
            'uid' => $data['uid'],
            'type' => $data['type'],
            'name' => $data['name'],
            'vendor' => $data['vendor'],
            'format' => $data['format'],
            'private' => $data['private'] ?? '',
        ];

        $view = isset($data['multiple']) ? 'multiple' : 'button';

        $view = View::make("media::{$view}", $data);

        return $view->render();
    }

    /**
     * Build image link
     * @param string $url
     * @return string Absolute image link
     */
    public function url($url)
    {
        return (env('APP_MEDIA') ?? url('')) . '/' . trim($url, '/');
    }

    /**
     * Get absolute url
     * @param string|null $path
     * @param int|null $width
     * @param int|null $height
     * @param string $action
     * @return string
     */
    public function image(string $path = null, int $width = null, int $height = null): string
    {
        if (strpos($path, 'http') === 0) {
            return $this->url("proxy/" . urlencode($path));
        } else {
            return $this->url("media/{$path}");
        }
    }

    public function thumb(string $path = null, int $width = 200, int $height = null)
    {
        if (empty($path)) {
            return '';
        }

        // Build thumb image with size
        $prefix = $width;
        $prefix = $prefix . ($height ? "x{$height}" : "");

        // Check external image or local
        if (strpos($path, 'http') === 0) {
            return $this->url("proxy/" . urlencode($path));
        } else {
            return $this->url("cache/{$prefix}/{$path}");
        }
    }
}
