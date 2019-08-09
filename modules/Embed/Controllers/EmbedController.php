<?php

namespace Modules\Embed\Controllers;

use Embed\Embed;

use Illuminate\Http\Request;

/**
 * Handle blog requests
 * @package Modules\Embed
 */
class EmbedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function embed(Request $request)
    {
        $url = $request->input('url');

        if (empty($url)) {
            return [
                'code' => 400,
                'message' => 'Invalid request',
            ];
        }

        $fields = [
            'title' => 'printText',
            'description' => 'printText',
            'url' => 'printUrl',
            'type' => 'printText',
            'tags' => 'printArray',
            'image' => 'printImage',
            'imageWidth' => 'printText',
            'imageHeight' => 'printText',
            'images' => 'printArray',
            'code' => 'printCode',
            'feeds' => 'printArray',
            'width' => 'printText',
            'height' => 'printText',
            'aspectRatio' => 'printText',
            'authorName' => 'printText',
            'authorUrl' => 'printUrl',
            'providerIcon' => 'printImage',
            'providerIcons' => 'printArray',
            'providerName' => 'printText',
            'providerUrl' => 'printUrl',
            'publishedTime' => 'printText',
            'license' => 'printUrl',
        ];

        $bucket = [];
        $embed = Embed::create($url);

        foreach($fields as $field => $format) {
            $bucket[$field] = $embed->{$field};
        }

        $bucket['html'] = $embed->code;

        return $bucket;
    }
}