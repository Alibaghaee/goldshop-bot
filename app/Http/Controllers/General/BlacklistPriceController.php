<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\Blacklist;
use App\Models\General\SmsUser;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlacklistPriceController extends Controller
{
    use AdminGuard;

    /**
     * Update the specified blacklist in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blacklist $blacklist)
    {
        $request->validate([
            'user_id'     => 'required',
            'user_price'  => 'required|integer|min:700|gte:admin_price',
            'admin_price' => 'required|integer|min:650',
        ]);

        $blacklist_price = SmsUser::findOrFail($request->user_id)->blacklistPrice()
            ->firstOrNew(['user_id' => $request->user_id]);

        $blacklist_price->user_price  = $request->user_price;
        $blacklist_price->admin_price = $request->admin_price;
        $blacklist_price->save();

        return response([
            'result' => true,
        ]);
    }

}
