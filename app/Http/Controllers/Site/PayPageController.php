<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\General\DiscountItem;
use App\Models\General\Package;
use App\Models\General\Purchase;
use App\Rules\DiscountCodeRule;
use App\Models\User;
use Illuminate\Http\Request;

class PayPageController extends Controller
{
    public function index()
    {
        return view(getSiteBladePath('modules.pay_page.index'), [
            'packages' => Package::all(),
        ]);
    }

    public function show(Package $package)
    {
        if (auth()->user()->payablePrice($package->id) <= 0) {
            return redirect('/');
        }

        return view(getSiteBladePath('modules.pay_page.show'), [
            'package' => $package,
        ]);
    }

    public function pay(Request $request, $locale, Package $package)
    {
        $request->validate([
            'discount_code' => ['nullable', new DiscountCodeRule],
            'type'          => 'required|in:1,2,3',
        ]);
        session()->put('discount_code', $request->discount_code);

        if ($request->type == 1) {
            $price       = $package->pre_payment; // Rial
            $description = 'پیش پرداخت';
            $type        = 1;
        } else if ($request->type == 2) {
            $price       = $package->price; // Rial
            $description = 'پرداخت یکجا';
            $type        = 2;
        } else if ($request->type == 3) {
            $price       = auth()->user()->payablePrice($package->id); // Rial
            $description = 'پرداخت تکمیلی';
            $type        = 3;
        }

        $discount_item = DiscountItem::where('code', $request->discount_code)->first();

        $payment = Purchase::create([
            'user_id'          => auth()->id(),
            'package_id'       => $package->id,
            'title'            => $package->title,
            'price'            => checkPriceDiscount($price),
            'description'      => $description,
            'type'             => $type,
            'discount_price'   => $price - checkPriceDiscount($price),
            'discount_item_id' => $discount_item ? $discount_item->id : null,
        ]);

        $payment_link = $payment->payment_link;

        return redirect($payment_link);
    }
}
