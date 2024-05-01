<?php

namespace App\Http\Controllers\General;

use App\Filters\InvoicePortalFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\InvoicePortal\InvoicePortalCollection;
use App\Traits\Controllers\AdminGuard;
use App\Models\General\InvoicePortal;
use Illuminate\Http\Request;

class InvoicePortalController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the invoice_portal.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, InvoicePortalFilters $filters)
    {
        if (request()->expectsJson()) {
            return new InvoicePortalCollection(InvoicePortal::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new invoice_portal.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model' => new InvoicePortal,
            'intyList' =>  InvoicePortal::$intyList,
            'tobList' =>  InvoicePortal::$tobList,
            'patternList' =>  InvoicePortal::$patternList,
            'subjectList' =>  InvoicePortal::$subjectList,
            'clientList' =>  [],
            'settlementMethodList' =>  InvoicePortal::$settlementMethodList,
        ]);
    }

    /**
     * Store a newly created invoice_portal in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        InvoicePortal::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('invoice_portals.index')]);
        }

        return redirect()
            ->route('invoice_portals.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified invoice_portal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(InvoicePortal $invoice_portal)
    {
        //
    }

    /**
     * Show the form for editing the specified invoice_portal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoicePortal $invoice_portal)
    {
        return view('admin.globals.edit', [
            'model'     => $invoice_portal,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified invoice_portal in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoicePortal $invoice_portal)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $invoice_portal->update($data);

        success_flash();
        return response(['redirect' => route('invoice_portals.index')]);
    }

    /**
     * Remove the specified invoice_portal from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoicePortal $invoice_portal)
    {
        return response([
            'result' => $invoice_portal->delete(),
        ]);
    }

    /**
     * Validate the invoice_portal store request.
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
     * Validate the invoice_portal update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, InvoicePortal $invoice_portal)
    {
        return $request->validate([
            //
        ]);
    }
}
