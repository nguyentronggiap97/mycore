<?php

namespace Modules\Blog\Traits;

use Modules\Store\Models\Tag;
use Modules\Media\Models\Media;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

trait PostEvent
{
    /**
     * Clean text data
     * Remove invalid text
     * Remove html tags
     */
    public static function clean($text)
    {
        return strip_tags(trim($text));
    }

    /**
     * Model event define
     *
     * @return void
     */
    public static function bootPostEvent() {
        static::saving(function ($model) {
            /**
             * Product content allow tags
             */
            $tags = [
                '<p>',
                '<a>',
                '<b>',
                '<i>',
                '<span>',
                '<small>',
                '<img>',
                '<video>',
                '<svg>',
                '<br>',
                '<hr>',
                '<ul>',
                '<li>',
                '<ol>',
                '<div>',
                '<table>',
                '<tr>',
                '<td>',
                '<th>',
                '<h1>',
                '<h2>',
                '<h3>',
                '<h4>',
                '<h5>',
                '<h6>',
                '<blockquote>',
                '<iframe>',
            ];

            $user = Auth::user();

            $model->uid = $user->id;
            // $model->pid = $user->pid;
            $model->type = static::clean($model->type ?? 'blog');
            $model->title = static::clean($model->title);
            $model->slug = $model->slug ?? Str::slug($model->title);

            /**
             * Remove all html tag from summary and content
             */
            $model->summary = static::clean($model->summary);
            $model->content = strip_tags($model->content, implode('', $tags));

            /**
             * Add model metadata
             */
            $model->created = now();
            $model->updated = now();

            /**
             * Cast model value before save
             */
            $casts = [
                'products' => 'array',
                'cates' => 'array',
                'tags' => 'array',
                'stats' => 'array',
                'meta' => 'array',
            ];

            foreach($casts as $key => $format) {
                $model->attributes[$key] = $model->attributes[$key] ?? [];
            }

            /**
             * Check to save dependency data object
             * @todo Save new tags
             * @todo Save new attribute to term
             * @todo Save new author data
             * @todo Save new collection data
             */
            $model->saveTags();
            $model->saveThumb();
            $model->saveCates();
            $model->saveStats();
            $model->cast();
        });
    }

    /**
     * Save model stats when save
     * @todo OK
     */
    public function saveStats()
    {
        $stats = [
            'reading' => 0,
        ];

        // Calculate reading time here
        // https://gist.github.com/tomhazledine/a5255b16a29ecb9f2ffb515158402f63
        // https://gist.github.com/mynameispj/3170442

        $this->stats = $stats;
    }

    /**
     * Save model tags when save
     * @todo OK
     */
    public function saveTags()
    {
        $tags = [];
        $list = $this->tags ?? request()->input('tags');

        foreach($list as $item) {
            if ($item = Tag::clean($item)) {
                $tagx = Tag::createWithName($item);
                $tags[] = $item;
            }
        }

        return $tags;
    }

    /**
     * Save post media {thumb}
     */
    public function saveThumb()
    {
        if ($thumb = $this->attributes['thumb']) {
            $this->thumb = Media::firstOrNew(['_id' => $thumb], ['_id' => $thumb])->getEmbedded2();
        }
    }

    /**
     * Save categoreis
     * @todo OK
     * @
     */
    public function saveCates()
    {
        $cates  = [];

        $cates = $this->attributes['cates'];
        $cates = array_map('intval', $cates);

        $this->cates = $cates;

        return $cates;
    }
}