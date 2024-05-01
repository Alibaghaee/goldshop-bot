<?php

namespace App\Http\Controllers\General;

use App\Exports\PaysExport;
use App\Filters\PayFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Pay\PayCollection;
use App\Models\General\City;
use App\Models\General\Pay;
use App\Models\General\Province;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PayController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the pay.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PayFilters $filters)
    {
        if (request()->expectsJson()) {
            return new PayCollection(Pay::filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['genders']                = config('portal.genders');
        $data['options']['fields']                 = config('portal.fields');
        $data['options']['provinces']              = Province::asOption();
        $data['options']['cities']                 = City::asOption();
        $data['options']['payment_filters_status'] = config('portal.payment_filters_status');
        $data['options']['refund_filters_status']  = config('portal.refund_filters_status');
        $data['options']['grades']                 = config('portal.grades');
        $data['options']['fields_of_study']        = config('portal.fields_of_study');
        $data['options']['payment_subjects']       = config('portal.payment_subjects');

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Export as Excel
     *
     * @param Request    $request [description]
     * @param PayFilters $filters [description]
     * @return \Illuminate\Http\Response
     */
    public function Export(Request $request, PayFilters $filters)
    {
        $payments = new PayCollection(Pay::with(['city', 'province'])->filter($filters)->get());
        return Excel::download(new PaysExport($payments), 'payments.xlsx');
    }
}
