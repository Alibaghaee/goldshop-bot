<?php

namespace App\Http\Controllers\General;

use App\Filters\PurchaseInvoiceFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseInvoice\PurchaseInvoiceCollection;
use App\Models\General\PurchaseInvoice;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class PurchaseInvoiceController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the purchase_invoice.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PurchaseInvoiceFilters $filters)
    {
        if (request()->expectsJson()) {
            return new PurchaseInvoiceCollection(PurchaseInvoice::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new purchase_invoice.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model' => new PurchaseInvoice,
        ]);
    }

    /**
     * Store a newly created purchase_invoice in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // upload files
        if (is_upload_request($request) && $request->has('image')) {
            $this->validateFile($request);
            return $request->user()->uploadFile($request->image, 'images/sale_invoices', true);
        }

        // validate
        $data = $this->validateStore($request);

        // create
        PurchaseInvoice::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash('فاکتور با موفقیت ثبت شد.');
            return response(['redirect' => route('purchase_invoices.index')]);
        }

        return redirect()
            ->route('purchase_invoices.index')
            ->with('flash', 'فاکتور با موفقیت ثبت شد.');
    }

    /**
     * Display the specified purchase_invoice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseInvoice $purchase_invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified purchase_invoice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseInvoice $purchase_invoice)
    {
        return view('admin.globals.edit', [
            'model'     => $purchase_invoice,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified purchase_invoice in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseInvoice $purchase_invoice)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $purchase_invoice->update($data);

        success_flash();
        return response(['redirect' => route('purchase_invoices.index')]);
    }

    /**
     * Remove the specified purchase_invoice from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseInvoice $purchase_invoice)
    {
        return response([
            'result' => $purchase_invoice->delete(),
        ]);
    }

    /**
     * Validate the purchase_invoice store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'description' => 'required|string|max:255',
            'image'       => 'required|string|max:255',
        ]);
    }

    /**
     * Validate the purchase_invoice update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, PurchaseInvoice $purchase_invoice)
    {
        return $request->validate([
            //
        ]);
    }

    public function validateFile(Request $request)
    {
        $request->validate([
            'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);
    }
}
