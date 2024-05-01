<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\Purchase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::guard('admin')->check()) {
                return $next($request);
            }

            // $data = $request->validate([
            //     'type' => 'required|in:product',
            //     'id'   => 'required|exists:products,id',
            // ]);

            // $count = Purchase::where('payed', true)
            //     ->with('details.product')
            //     ->whereHas('details.product', function ($query) use ($request) {
            //         $query->where('user_id', auth()->id())
            //             ->where('active', true)
            //             ->where('id', $request->id)
            //             ->whereHas('items', function ($query) use ($request) {
            //                 $query->where('active', true)
            //                     ->where('file', '/files/' . $request->path);
            //             });
            //     })->count();

            if (Auth::guard('web')->check()) {
                return $next($request);
            }
        });
    }

    public function getFile(Request $request, $id, $type, $path)
    {
        $path = implode('/', [$id, $type, base64_decode($path)]);
        abort_if(
            !Storage::disk('files')->exists($path),
            404,
            "فایل وجود ندارد، مسیر فایل را بررسی کنید."
        );

        $stream = new \App\Http\VideoStream(storage_path('app/files/' . $path));

        return response()->stream(function () use ($stream) {
            $stream->start();
        });
    }

    public function getJozveh($path)
    {
        abort_if(
            !Storage::disk('files')->exists($path),
            404,
            "فایل وجود ندارد، مسیر فایل را بررسی کنید."
        );

        return Storage::disk('files')->download($path);
    }
    
}
