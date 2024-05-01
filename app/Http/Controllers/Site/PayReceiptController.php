<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Rules\NationalCode;
use App\Rules\Persian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use PDF;
use App\Models\General\Pay;

class PayReceiptController extends Controller
{
    public function receipt(Request $request)
    {
        $pay = Pay::findOrFail($request->session()->get('pay_id'));

        return view('site.fa.modules.pay.receipt', compact('pay'));
    }

    public function pdf(Request $request)
    {
        $data = [
            'pay' => Pay::findOrFail($request->session()->get('pay_id')),
        ];

        $pdf = PDF::loadView('pdf.pay.receipt', $data);
        return $pdf->download('receipt.pdf');
    }
}
