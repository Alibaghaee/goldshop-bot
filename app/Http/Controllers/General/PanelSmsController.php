<?php

namespace App\Http\Controllers\General;

use App\Filters\PanelSmsFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\PanelSms\PanelSmsCollection;
use App\Traits\Controllers\AdminGuard;
use App\Models\General\PanelSms;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PanelSmsController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the panel_sms.
     *
     */
    public function index(Request $request, PanelSmsFilters $filters)
    {
        if (request()->expectsJson()) {
            return new PanelSmsCollection(PanelSms::with('senderNumbers')->filter($filters)
                ->with('senderNumbers')
                ->paginate(get_per_page($request)));
        }


        $data['options']['status_list'] = PanelSms::$STATUS_LIST;
        $data['options']['domain_list'] = PanelSms::$DOMAIN_LIST;
        $data['options']['type_list'] = PanelSms::$TYPE_LIST;


        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new panel_sms.
     *
     */
    public function create()
    {

        return view('admin.globals.create', [
            'model' => new PanelSms,
            'status' => PanelSms::$STATUS_LIST,
            'domain' => PanelSms::$DOMAIN_LIST,
            'type' => PanelSms::$TYPE_LIST,

        ]);
    }

    /**
     * Store a newly created panel_sms in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        PanelSms::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('panel_sms.index')]);
        }

        return redirect()
            ->route('panel_sms.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified panel_sms.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(PanelSms $panel_sm)
    {

    }

    /**
     * Show the form for editing the specified panel_sms.
     *
     * @param PanelSms $panel_sms
     */
    public function edit(PanelSms $panel_sm)
    {

        return view('admin.globals.edit', [
            'model' => $panel_sm,
            'edit_form' => true,
            'status' => PanelSms::$STATUS_LIST,
            'domain' => PanelSms::$DOMAIN_LIST,
            'type' => PanelSms::$TYPE_LIST,
        ]);
    }

    /**
     * Update the specified panel_sms in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PanelSms $panel_sm)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $panel_sm->update($data);

        success_flash();
        return response(['redirect' => route('panel_sms.index')]);
    }

    /**
     * Remove the specified panel_sms from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PanelSms $panel_sm)
    {
        return response([
            'result' => $panel_sm->delete(),
        ]);
    }

    /**
     * Validate the panel_sms store request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateStore(Request $request)
    {

        $data = $request->validate([
            'domain' => 'required',
            'status' => 'required',
            'type' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
        $data['status'] = $data['status']['id'];
        $data['domain'] = $data['domain']['id'];
        $data['type'] = $data['type']['id'];

        return $data;
    }

    /**
     * Validate the panel_sms update request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateUpdate(Request $request, PanelSms $panel_sms)
    {
        return $request->validate([
            //
        ]);
    }


}
