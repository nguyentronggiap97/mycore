<?php

namespace Modules\Media\Controllers;

use Log;
use File;
use Auth;
use Image;
use Storage;
use Response;
use Media as Photo;
use Hashids;

use App\Guid;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Media\Models\Media;

/**
 * Handle user requests
 * @package Modules\Store
 */
class MediaController extends Controller
{
    public function index(Request $request)
    {
        return 'OK';
    }

    public function update(Request $request)
    {
        // Validate media metadata
        $this->validate($request, [
            'id' => 'required|string|max:32',
            'caption' => 'required|string|max:255',
        ]);

        $id     = $request->input('id');
        $text   = $request->input('caption');

        $media  = Media::where(['_id' => $id])->update(['caption' => $text]);

        return $media;
    }

    public function delete(Request $request)
    {
        // Validate media metadata
        $this->validate($request, [
            'id' => 'required|string|max:32',
        ]);
        
        $media = $request->input('id');
        $media = Media::where(['_id' => $media])->first();
        $media->forceDelete();

        if ($media) {
            Storage::disk('media')->delete($media->path);
        }

        return $media;
    }

    /**
     * Get list media has uploaded for listing dialog
     */
    public function uploaded(Request $request)
    {
        $query = Media::query();

        // Check for special user images
        if ($user = $request->input('uid')) {
            $query->where('uid', $user);
        }

        // Check for current user private images
        if ($user = $request->input('private')) {
            $query->where('uid', Auth::user()->id);
        }

        // Check for image type
        if ($type = $request->input('type')) {
            $query->where('type', $type);
        }

        // Check for vendor images
        if ($vendor = $request->input('vendor')) {
            $query->where('vendor', $vendor);
        }

        $files = $query->get();

        // Build response
        $uploads = [];

        foreach($files as $item) {
            $uploads[] = [
                'id' => $item->_id,
                'name' => $item->name,
                'ext' => $item->ext,
                'width' => $item->width,
                'height' => $item->height,
                'caption' => $item->caption,
                'src' => $item->path,
                'link' => $item->link,
                'thumb' => $item->thumb
            ];
        }

        return [
            'uploads' => $uploads
        ];
    }

    /**
     * Get image from external
     */
    public function proxy($url = null)
    {   $url  = request('url', $url);
        $url  = urldecode($url);
        $ext  = File::extension($url);
        $hash = md5($url);
        $disk = "proxy/{$hash}.{$ext}";
        $path = storage_path("cache/{$disk}");

        if (false == Storage::disk('cache')->exists($disk)) {
            // $width  = request()->route('width');
            // $height = request()->route('height');

            // Create cache dir
            Storage::disk('cache')->makeDirectory('proxy');

            // Get file from remote and cache
            if ($content = file_get_contents($url)) {
                file_put_contents($path, $content);
            }
        }

        return response()->file($path);
    }

    /**
     * Get image with origin size
     */
    public function media($path)
    {
        $file = storage_path("media/{$path}");

        if (false == Storage::disk('media')->exists($path)) {
            return Response::make('File not found: ' . $path, 404);
        }

        return response()->file($file);
    }

    /**
     * Resize image to width and cache
     */
    public function cache($width, $path)
    {
        $file = pathinfo($path);

        // Cache image information
        $cacheDir  = $file['dirname'];
        $cacheFile = $file['filename'] . "_{$width}." . $file['extension'];
        $cacheDisk = "{$cacheDir}/{$cacheFile}";
        $cachePath = storage_path("cache/{$cacheDisk}");

        // Origin image information
        $mediaFile = "media/{$path}";
        $mediaPath = storage_path($mediaFile);

        // Check cache image exists
        if (Storage::disk('cache')->exists($cacheDisk)) {
            return response()->file($cachePath);
        }
        
        // Check media image exists
        if (Storage::disk('media')->exists($path) == false) {
            return Response::make('File not found: ' . $path, 404);
        }

        // Create cache dir
        Storage::disk('cache')->makeDirectory($cacheDir);

        // Create image instance
        $image = Image::make($mediaPath);

        // Get new width and check limit
        $newWidth = $width;
        $newWidth = $newWidth > $image->width() ? $image->width() : $newWidth;
        $newWidth = $newWidth > config('media.max.width') ? config('media.max.width') : $newWidth;

        // Resize image to width
        $image->resize($newWidth, null, function($constraint) {
            $constraint->aspectRatio();
        });

        // Save cache image to disk
        $image->save($cachePath);

        // Response image to client
        return $image->response($image->mime());
    }

    /**
     * Resize image to {width x height} and cache to local
     */
    public function resize($width, $height, $path)
    {
        $file = pathinfo($path);

        // Cache image information
        $cacheDir  = $file['dirname'];
        $cacheFile = $file['filename'] . "_{$width}x{$height}." . $file['extension'];
        $cacheDisk = "{$cacheDir}/{$cacheFile}";
        $cachePath = storage_path("cache/{$cacheDisk}");

        // Check and resize origin to size
        $mediaFile = "media/{$path}";
        $mediaPath = storage_path($mediaFile);

        // Check cache image exists
        if (Storage::disk('cache')->exists($cacheDisk)) {
            return response()->file($cachePath);
        }

        // Check media image exists
        if (Storage::disk('media')->exists($path) == false) {
            return Response::make('File not found: ' . $path, 404);
        }

        // Create cache dir
        Storage::disk('cache')->makeDirectory($cacheDir);

        // Resize image to width
        $image = Image::make($mediaPath);

        // Calculate cache image size
        $ratio = $image->width()/$image->height();

        $newWidth  = $width;
        $newHeight = $height;

        $newWidth  = $newWidth > $image->width() ? $image->width() : $newWidth;
        $newWidth  = $newWidth > config('media.max.width') ? config('media.max.width') : $newWidth;

        $newHeight = $newHeight > $image->height() ? $image->height() : $newHeight;
        $newHeight = $newHeight > config('media.max.height') ? config('media.max.height') : $newHeight;

        $newRatio  = $newWidth/$newHeight;

        // Keep full image
        if ($newRatio < $ratio) {
            // Resize to newHeight, crop to newWidth, newHeight
            $image->resize($newWidth, null, function($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            // Resize to newWidth, crop to newWidth, newHeight
            $image->resize(null, $newHeight, function($constraint) {
                $constraint->aspectRatio();
            });
        }
        
        // Save cache image to disk: trans rgba(0, 0, 0, 0)
        $image->resizeCanvas($newWidth, $newHeight, 'center', false, 'ffffff');

        $image->save($cachePath);

        // Response image to client
        return $image->response($image->mime());
    }

    /**
     * Upload media to server
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        // Validate media metadata
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ]);

        // Get media file content
        $file = $request->file('file');
        
        // Make image object
        $image = Image::make($file->getRealPath());
        
        $width  = $image->width();
        $height = $image->height();
        
        $resize = false;

        // Check image size limit
        if ($width > config('media.max.width')) {
            $width = config('media.max.width');
            $resize = true;
        }

        if ($height > config('media.max.height')) {
            $height = config('media.max.height');
            $resize = true;
        }

        if ($resize) {
            $image->resize($width, $height, function($constraint) {
                $constraint->aspectRatio();
            })->save($file->getRealPath());
        }

        // Build media information
        $disk   = 'media';
        $name   = Hashids::encode(Guid::next()) . '.' . $file->extension();

        $folder = date('Ym');
        $folder = dechex($folder);

        if ($type = $request->input('type')) {
            $folder = "{$type}/{$folder}";
        }

        // Check store folder
        Storage::disk($disk)->makeDirectory($folder);
        
        $path = $file->storeAs($folder, $name, $disk);

        // Save media to database
        $media = Media::create([
            'uid' => Auth::user()->id,
            'type' => $type,
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'ext' => $file->extension(),
            'vendor' => $request->input('vendor', 'default'),
            'caption' => '',
            'size' => $file->getSize(),
            'width' => $width,
            'height' => $height,
            'status' => 1,
            'created' => now(),
            'updated' => now(),
        ]);

        // Build response data
        return [
            'id' => $media->id,
            'name' => $media->name,
            'ext' => $media->ext,
            'width' => $width,
            'heigh' => $height,
            'caption' => $media->caption,
            'src' => $path,
            'link' => Photo::image($path),
            'thumb' => Photo::thumb($folder . '/' . $name)
        ];
    }
}