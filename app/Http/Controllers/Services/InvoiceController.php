<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\InvoiceRequest;
use App\Models\Invoice;
use App\Models\InvoicePacket;
use App\Traits\Controller\ObjectGuard;


class InvoiceController extends Controller
{
    use ObjectGuard;

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $invoices = Invoice::orderByDesc('created_at')->paginate(9);

        return view('site.module.invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
//        $invoice = Invoice::create();
//        $invoice->invoicePacket()->associate(InvoicePacket::create(['account_id' => $this->accountId(), 'packet_type' => 'INVOICE.V01']));
//        $invoice->save();
        $intyList=\App\Models\InvoiceHeader::$intyList;
        return view('site.module.invoice.create',compact('intyList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(InvoiceRequest $request)
    {
        Invoice::create($request->validated());

        return redirect()->route('site.invoice.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Invoice $invoice
     */
    public function show(Invoice $invoice)
    {
        return view('site.module.invoice.create', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Invoice $invoice
     */
    public function edit(Invoice $invoice)
    {
        return view('site.module.invoice.create', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Invoice $invoice
     */
    public function update(InvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update($request->validated());

        return redirect()->route('site.invoice.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Invoice $invoice
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('site.invoice.index');
    }
}
