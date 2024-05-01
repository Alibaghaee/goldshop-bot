<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\InvoicePaymentRequest;
use App\Models\Invoice;
use App\Models\InvoicePayment;


class InvoicePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $invoiceBodies = InvoicePayment::orderByDesc('created_at')->paginate(9);

        return view('site.module.invoice_payment.index', compact('invoiceBodies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(Invoice $invoice)
    {
        return view('site.module.invoice_payment.create', compact('invoice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(InvoicePaymentRequest $request)
    {
        InvoicePayment::create($request->validated());

        return redirect()->route('site.invoice_payment.index');
    }

    /**
     * Display the specified resource.
     *
     * @param InvoicePayment $invoiceBody
     */
    public function show(InvoicePayment $invoiceBody)
    {
        return view('site.module.invoice_payment.create', compact('invoiceBody'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param InvoicePayment $invoiceBody
     */
    public function edit(InvoicePayment $invoiceBody)
    {
        return view('site.module.invoice_payment.create', compact('invoiceBody'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param InvoicePayment $invoiceBody
     */
    public function update(InvoicePaymentRequest $request, InvoicePayment $invoiceBody)
    {
        $invoiceBody->update($request->validated());

        return redirect()->route('site.invoice_payment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param InvoicePayment $invoiceBody
     */
    public function destroy(InvoicePayment $invoiceBody)
    {
        $invoiceBody->delete();

        return redirect()->route('site.invoice_payment.index');
    }
}
