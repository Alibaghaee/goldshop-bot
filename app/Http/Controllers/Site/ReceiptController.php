<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\General\Purchase;
use App\Models\User;
use PDF;

class ReceiptController extends Controller
{
    public function receipt(Purchase $purchase)
    {
        $user     = \Auth::user();
        $payments = $purchase->package->purchases()->with('package')->where('user_id', $user->id)->payed()->get();

        return view('site.fa.modules.receipt.show', compact('user', 'payments'));
    }

    public function pdf()
    {
        $data = [
            'user'     => \Auth::user(),
            'payments' => \Auth::user()->purchases()->payed()->get(),
        ];

        $pdf = PDF::loadView('pdf.receipt', $data);
        return $pdf->download('receipt.pdf');
    }
}
