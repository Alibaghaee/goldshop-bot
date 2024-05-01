<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\InvoiceHeaderRequest;
use App\Models\Invoice;
use App\Models\InvoiceHeader;
use Illuminate\Http\Request;

class InvoiceHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $invoiceHeaders = InvoiceHeader::orderByDesc('created_at')->paginate(9);

        return view('site.module.invoice_header.index', compact('invoiceHeaders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('site.module.invoice_header.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(InvoiceHeaderRequest $request)
    {
        $invoiceHeader = InvoiceHeader::create($request->validated());
        $invoice = $invoiceHeader->invoice;
        return redirect()->route('site.invoice_body.create',['invoice'=>$invoice]);
    }

    /**
     * Display the specified resource.
     *
     * @param InvoiceHeader $invoiceHeader
     */
    public function show(InvoiceHeader $invoiceHeader)
    {
        return view('site.module.invoice_header.create', compact('invoiceHeader'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param InvoiceHeader $invoiceHeader
     */
    public function edit(InvoiceHeader $invoiceHeader)
    {
        return view('site.module.invoice_header.create', compact('invoiceHeader'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param InvoiceHeader $invoiceHeader
     */
    public function update(InvoiceHeaderRequest $request, InvoiceHeader $invoiceHeader)
    {
        $invoiceHeader->update($request->validated());

        return redirect()->route('site.invoice_header.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param InvoiceHeader $invoiceHeader
     */
    public function destroy(InvoiceHeader $invoiceHeader)
    {
        $invoiceHeader->delete();

        return redirect()->route('site.invoice_header.index');
    }
}
