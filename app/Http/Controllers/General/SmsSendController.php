<?php

namespace App\Http\Controllers\General;

use App\Filters\SmsSendFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\SmsSend\SmsSendCollection;
use App\Traits\Controllers\AdminGuard;
use App\Models\General\SmsSend;
use Illuminate\Http\Request;

class SmsSendController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the sms_send.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, SmsSendFilters $filters)
    {
        if (request()->expectsJson()) {
            return new SmsSendCollection(SmsSend::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new sms_send.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model' => new SmsSend,
        ]);
    }

    /**
     * Store a newly created sms_send in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        SmsSend::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('sms_sends.index')]);
        }

        return redirect()
            ->route('sms_sends.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified sms_send.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SmsSend $sms_send)
    {
        //
    }

    /**
     * Show the form for editing the specified sms_send.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SmsSend $sms_send)
    {
        return view('admin.globals.edit', [
            'model'     => $sms_send,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified sms_send in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SmsSend $sms_send)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $sms_send->update($data);

        success_flash();
        return response(['redirect' => route('sms_sends.index')]);
    }

    /**
     * Remove the specified sms_send from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SmsSend $sms_send)
    {
        return response([
            'result' => $sms_send->delete(),
        ]);
    }

    /**
     * Validate the sms_send store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            
        ]);
    }

    /**
     * Validate the sms_send update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, SmsSend $sms_send)
    {
        return $request->validate([
            //
        ]);
    }
}
