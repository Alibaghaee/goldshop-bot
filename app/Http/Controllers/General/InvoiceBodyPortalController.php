<?php

namespace App\Http\Controllers\General;

use App\Filters\InvoiceBodyPortalFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceBodyPortal\InvoiceBodyPortalCollection;
use App\Traits\Controllers\AdminGuard;
use App\Models\General\InvoicePortal;
use App\Models\General\InvoiceBodyPortal;
use Illuminate\Http\Request;

class InvoiceBodyPortalController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the invoice_body_portal.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InvoicePortal $invoice_portal, Request $request, InvoiceBodyPortalFilters $filters)
    {
        if (request()->expectsJson()) {
            return new InvoiceBodyPortalCollection($invoice_portal->items()->filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index-items', ['model' => $invoice_portal]);
    }

    /**
     * Show the form for creating a new invoice_body_portal.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(InvoicePortal $invoice_portal)
    {
        return view('admin.globals.create', [
            'model' => new InvoiceBodyPortal,
            'invoice_portal' => $invoice_portal,
        ]);
    }

    /**
     * Store a newly created invoice_body_portal in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoicePortal $invoice_portal, Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $invoice_portal->items()->create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('invoice_portals.invoice_body_portals.index', ['invoice_portal' => $invoice_portal->id])]);
        }

        return redirect()
            ->route('invoice_portals.invoice_body_portals.index', ['invoice_portal' => $invoice_portal->id])
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified invoice_body_portal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(InvoicePortal $invoice_portal, InvoiceBodyPortal $invoice_body_portal)
    {
        //
    }

    /**
     * Show the form for editing the specified invoice_body_portal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoicePortal $invoice_portal, InvoiceBodyPortal $invoice_body_portal)
    {
        return view('admin.globals.edit', [
            'model'                                => $invoice_body_portal,
            'edit_form'                            => true,
            'invoice_portal' => $invoice_portal,
        ]);
    }

    /**
     * Update the specified invoice_body_portal in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InvoicePortal $invoice_portal, InvoiceBodyPortal $invoice_body_portal, Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $invoice_body_portal->update($data);

        success_flash();
        return response(['redirect' => route('invoice_portals.invoice_body_portals.index', ['invoice_portal' => $invoice_portal->id])]);
    }

    /**
     * Remove the specified invoice_body_portal from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoicePortal $invoice_portal, InvoiceBodyPortal $invoice_body_portal)
    {
        return response([
            'result' => $invoice_body_portal->delete(),
        ]);
    }

    /**
     * Validate the invoice_body_portal store request.
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
     * Validate the invoice_body_portal update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, InvoiceBodyPortal $invoice_body_portal)
    {
        return $request->validate([
            //
        ]);
    }
}
