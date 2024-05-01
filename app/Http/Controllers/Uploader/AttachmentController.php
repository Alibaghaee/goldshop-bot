<?php

namespace App\Http\Controllers\Uploader;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class AttachmentController extends Controller
{


    public function editorUpload(Request $request)
    {
        ini_set('upload_max_filesize', '1024M');
        ini_set('post_max_size', '1024M');
        ini_set('memory_limit', '1024M');
        ini_set('output_buffering', 'On');


        $uuid = (string)Str::uuid();
        File::makeDirectory(public_path("/storage/editor/$uuid"), 0755, true, true);


        $file = $request->file('image');


        $filename = $file->getClientOriginalName();
        $file->move(public_path("/storage/editor/$uuid"), $filename);

        return response([
            'location' => "/storage/editor/$uuid/$filename",
        ]);
    }


    public function destroyFile(Request $request)
    {
        $request->validate([
            'file' => 'required'
        ]);

        return response(['result' => File::delete(public_path($request->file))]);
    }
}
