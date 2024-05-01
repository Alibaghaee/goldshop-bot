<?php

namespace App\Http\Controllers\General;

use App\Exports\PurchasesExport;
use App\Filters\PurchaseFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Purchase\PurchaseCollection;
use App\Models\General\Package;
use App\Models\General\Purchase;
use App\Traits\Controllers\AdminGuard;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PurchaseController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the purchase.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PurchaseFilters $filters)
    {
        if (request()->expectsJson()) {
            return new PurchaseCollection(Purchase::with(['user', 'user.city', 'user.province', 'user.purchases', 'package'])->filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['users']    = true ? User::with(['city', 'province'])->asOption() : [];
        $data['options']['status']   = config('portal.purchase_status');
        $data['options']['packages'] = Package::asOption();

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for editing the specified purchase.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        return view('admin.globals.edit', [
            'model'           => $purchase,
            'edit_form'       => true,
            'purchase_status' => config('portal.purchase_status'),
            'payment_status'  => config('portal.payment_status'),
        ]);
    }

    /**
     * Update the specified purchase in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        // validate
        $data = $this->validateUpdate($request, $purchase);

        // create
        $purchase->update($data);

        success_flash();
        return response(['redirect' => route('purchases.index')]);
    }

    /**
     * Validate the purchase update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, Purchase $purchase)
    {
        $data = $request->validate([
            'payed.id'    => 'required|in:0,1',
            'status.id'   => 'nullable',
            'description' => 'nullable|string',
        ]);

        return multiselect_adapter($data);
    }

    /**
     * Export as Excel
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Export(Request $request, PurchaseFilters $filters)
    {
        $purchases = new PurchaseCollection(Purchase::with(['user', 'user.city', 'user.province', 'user.purchases', 'package'])->filter($filters)->get());
        return Excel::download(new PurchasesExport($purchases), 'purchases.xlsx');
    }
}
