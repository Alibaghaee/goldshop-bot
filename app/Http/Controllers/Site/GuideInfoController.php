<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class GuideInfoController extends Controller
{
    public function exportPdf()
    {

//        return response()->download(  'guide_info\index.pdf');

        return Storage::disk('public')->download(  'guide_info/index.pdf');
//        return Storage::download(storage_path('app/public/' . 'guide_info\index.pdf'), 'guide.pdf');
    }
}
