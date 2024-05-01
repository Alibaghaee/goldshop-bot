<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Intervention\Image\Facades\Image;

class ResizeImageController extends Controller
{
    /**
     * cache image
     * @param  [type]  $width
     * @param  [type]  $height
     * @param  string  $type
     * @param  [type]  $filepath
     * @return Illuminate\Http\Response
     */
    public function resize($width, $height, $type, $filepath)
    {
        if (!in_array($type, ['fit', 'resize'])) {
            return;
        }

        $cache_image = Image::cache(function ($image) use ($width, $height, $type, $filepath) {
            if ($height == 0) {
                return $image->make($filepath)->resize($width, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            return $image->make($filepath)->$type($width, $height);
        }, 0); // cache for 0 minute

        // define mime type
        $mime = finfo_buffer(finfo_open(FILEINFO_MIME_TYPE), $cache_image);

        // return http response
        return new Response($cache_image, 200, array(
            'Content-Type'  => $mime,
            'Cache-Control' => 'max-age=' . (config('imagecache.lifetime') * 60) . ', public',
            'Etag'          => md5($cache_image),
        ));
    }
}
