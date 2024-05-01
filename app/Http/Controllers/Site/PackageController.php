<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\General\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        return view(getSiteBladePath('modules.packages.index'), [
            'packages' => Package::all(),
        ]);
    }

    public function show(Request $request, Package $package)
    {
        if (auth()->user()->hasPackage($package->id)) {
            return redirect($package->products_url);
        }else{
            return redirect($package->purchase_url);
        }
    }
}
