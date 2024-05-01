<?php

namespace App\Http\Controllers\General;

use App\Filters\RefundFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Refund\RefundCollection;
use App\Traits\Controllers\AdminGuard;
use App\Models\General\Refund;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the refund.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, RefundFilters $filters)
    {
        if (request()->expectsJson()) {
            return new RefundCollection(Refund::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new refund.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model' => new Refund,
        ]);
    }

    /**
     * Store a newly created refund in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        Refund::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('refunds.index')]);
        }

        return redirect()
            ->route('refunds.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified refund.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Refund $refund)
    {
        //
    }

    /**
     * Show the form for editing the specified refund.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Refund $refund)
    {
        return view('admin.globals.edit', [
            'model'     => $refund,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified refund in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Refund $refund)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $refund->update($data);

        success_flash();
        return response(['redirect' => route('refunds.index')]);
    }

    /**
     * Remove the specified refund from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Refund $refund)
    {
        return response([
            'result' => $refund->delete(),
        ]);
    }

    /**
     * Validate the refund store request.
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
     * Validate the refund update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, Refund $refund)
    {
        return $request->validate([
            //
        ]);
    }
}
