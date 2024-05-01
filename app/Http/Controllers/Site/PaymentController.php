<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // public function supplementary_payment(Request $request)
    // {
    //     $request->validate([
    //         'confirm' => 'required|in:1',
    //     ]);

    //     $user = User::where('national_code', session('national_code'))->first();

    //     \Auth::loginUsingId($user->id);

    //     if ($user->payable_price == 0) {
    //         return response([
    //             'redirect' => '/' . app()->getLocale(),
    //         ]);
    //     }

    //     $payment = auth()->user()->payments()->create([
    //         'title' => 'پرداخت تکمیلی',
    //         'price' => $user->payable_price, // Rial
    //     ]);

    //     // go to bank
    //     return response([
    //         'redirect' => '/' . app()->getLocale() . '/bank/request?id=' . $payment->id,
    //     ]);
    // }
}
