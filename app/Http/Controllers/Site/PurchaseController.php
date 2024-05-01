<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\General\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        return view(getSiteBladePath('modules.purchases.index'), [
            'purchases' => $this->purchases(),
        ]);
    }

    protected function purchases()
    {
        return Purchase::query()
            ->payed()
            ->with('package')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
    }
}
