<?php

namespace App\Http\Controllers\General;

use App\Exports\PaymentsExport;
use App\Filters\PaymentFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Payment\PaymentCollection;
use App\Models\General\Payment;
use App\Traits\Controllers\AdminGuard;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PaymentController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the payment.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PaymentFilters $filters)
    {
        if (request()->expectsJson()) {
            return new PaymentCollection(Payment::with(['user', 'user.city', 'user.province', 'user.payments'])->filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['users'] = true ? User::asOption() : [];

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Validate the payment store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            //
        ]);
    }

    /**
     * Validate the payment update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, Payment $payment)
    {
        return $request->validate([
            //
        ]);
    }

    /**
     * Export as Excel
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Export(Request $request, PaymentFilters $filters)
    {
        $payments = new PaymentCollection(Payment::with(['user', 'user.city', 'user.province', 'user.payments'])->filter($filters)->get());
        return Excel::download(new PaymentsExport($payments), 'payments.xlsx');
    }
}
