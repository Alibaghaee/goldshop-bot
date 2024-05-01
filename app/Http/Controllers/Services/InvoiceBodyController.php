<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\InvoiceBodyRequest;
use App\Models\Invoice;
use App\Models\InvoiceBody;


class InvoiceBodyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $invoiceBodies = InvoiceBody::orderByDesc('created_at')->paginate(9);

        return view('site.module.invoice_body.index', compact('invoiceBodies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(Invoice $invoice)
    {
        return view('site.module.invoice_body.create', compact('invoice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(InvoiceBodyRequest $request)
    {
        $invoiceBody = InvoiceBody::create($request->validated());
        $invoice = $invoiceBody->invoice;
        return redirect()->route('site.invoice_payment.create', compact('invoice'));
    }

    /**
     * Display the specified resource.
     *
     * @param InvoiceBody $invoiceBody
     */
    public function show(InvoiceBody $invoiceBody)
    {
        return view('site.module.invoice_body.create', compact('invoiceBody'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param InvoiceBody $invoiceBody
     */
    public function edit(InvoiceBody $invoiceBody)
    {
        return view('site.module.invoice_body.create', compact('invoiceBody'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param InvoiceBody $invoiceBody
     */
    public function update(InvoiceBodyRequest $request, InvoiceBody $invoiceBody)
    {
        $invoiceBody->update($request->validated());

        return redirect()->route('site.invoice_body.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param InvoiceBody $invoiceBody
     */
    public function destroy(InvoiceBody $invoiceBody)
    {
        $invoiceBody->delete();

        return redirect()->route('site.invoice_body.index');
    }
}
