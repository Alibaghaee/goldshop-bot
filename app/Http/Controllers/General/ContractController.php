<?php

namespace App\Http\Controllers\General;

use App\Filters\ContractFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Contract\ContractCollection;
use App\Models\General\Contract;
use App\Models\General\Customer;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;
use PDF;

class ContractController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the contract.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ContractFilters $filters)
    {
        if (request()->expectsJson()) {
            return new ContractCollection(Contract::filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['customers'] = Customer::asOption();

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new contract.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model'     => new Contract,
            'customers' => Customer::asOption(),
            'patterns'  => Contract::isPattern()->asOption(),
        ]);
    }

    /**
     * Store a newly created contract in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // upload files
        if (is_upload_request($request) && $request->has('file')) {
            $this->validateFile($request);
            return $request->user()->uploadFile($request->file, 'files/contract', true);
        }

        // validate
        $data = $this->validateStore($request);

        // create
        Contract::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('contracts.index')]);
        }

        return redirect()
            ->route('contracts.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified contract.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified contract.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        return view('admin.modules.contracts.edit', [
            'model'     => $contract,
            'customers' => Customer::asOption(),
            'edit_form' => true,
            'patterns'  => Contract::isPattern()->asOption(),
        ]);
    }

    /**
     * Update the specified contract in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $contract->update($data);

        success_flash();
        return response(['redirect' => route('contracts.index')]);
    }

    /**
     * Remove the specified contract from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        return response([
            'result' => $contract->delete(),
        ]);
    }

    public function export(Contract $contract)
    {
        $pdf  = PDF::loadView('admin.pdf.contract', compact('contract'));

        return $pdf->stream($contract->title . '.pdf');
    }

    /**
     * Validate the contract store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        $data = $request->validate([
            'customer_id.id' => 'required|exists:customers,id',
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'body'           => 'required|string',
            'file'           => 'nullable|string|max:255',
            'is_pattern'     => 'nullable|boolean',
        ]);

        return multiselect_adapter($data);
    }

    /**
     * Validate the contract update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, Contract $contract)
    {
        return $request->validate([
            //
        ]);
    }

    public function validateFile(Request $request)
    {
        $request->validate([
            'document' => 'file|mimes:jpeg,png,jpg,doc,docx,xls,xlsx,pdf,zip,7z',
        ]);
    }
}
