<?php

namespace App\Http\Controllers\General;

use App\Filters\SenderNumberFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\AsOptionResorceCollection;
use App\Http\Resources\SenderNumber\SenderNumberCollection;
use App\Models\General\ContactCategory;
use App\Models\General\PanelSms;
use App\Traits\Controllers\AdminGuard;
use App\Models\General\SenderNumber;
use Illuminate\Http\Request;

class SenderNumberController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the sender_number.
     *
     */
    public function index(Request $request, SenderNumberFilters $filters)
    {
        if (request()->expectsJson()) {

            return new SenderNumberCollection(SenderNumber::filter($filters)
                ->with('panelSms')
                ->paginate(get_per_page($request)));
        }


        $data['options']['status_list'] = SenderNumber::$STATUS_LIST;
        $data['options']['type_list'] = SenderNumber::$TYPE_LIST;
        $data['options']['domain_list'] = PanelSms::$DOMAIN_LIST;
        $data['options']['dargah_list'] = SenderNumber::$DARGAH_LIST;

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new sender_number.
     *
     */
    public function create()
    {

        return view('admin.globals.create', [
            'model' => new SenderNumber,
            'status' => SenderNumber::$STATUS_LIST,
            'type' => SenderNumber::$TYPE_LIST,
            'panels' => new AsOptionResorceCollection(PanelSms::published()->get()),
        ]);
    }

    /**
     * Store a newly created sender_number in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        SenderNumber::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('sender_numbers.index')]);
        }

        return redirect()
            ->route('sender_numbers.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified sender_number.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(SenderNumber $sender_number)
    {
        //
    }

    /**
     * Show the form for editing the specified sender_number.
     *
     * @param int $id
     */
    public function edit(SenderNumber $sender_number)
    {
        return view('admin.globals.edit', [
            'model' => $sender_number,
            'edit_form' => true,
            'status' => SenderNumber::$STATUS_LIST,
            'type' => SenderNumber::$TYPE_LIST,
            'panels' => new AsOptionResorceCollection(PanelSms::published()->get()),

        ]);
    }

    /**
     * Update the specified sender_number in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SenderNumber $sender_number)
    {
        // validate
        $data = $this->validateStore($request);
        // create
        $sender_number->update($data);


        success_flash();
        return response(['redirect' => route('sender_numbers.index')]);
    }

    /**
     * Remove the specified sender_number from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SenderNumber $sender_number)
    {
        return response([
            'result' => $sender_number->delete(),
        ]);
    }

    /**
     * Validate the sender_number store request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        $data = $request->validate([
            'number' => 'required',
            'status' => 'required',
            'type' => 'required',
            'panel_sms_id' => 'required',
        ]);
        $data['panel_sms_id'] = $data['panel_sms_id']['id'];
        $data['status'] = $data['status']['id'];
        $data['type'] = $data['type']['id'];


        return $data;
    }

    /**
     * Validate the sender_number update request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateUpdate(Request $request, SenderNumber $sender_number)
    {
        return $request->validate([
            //
        ]);
    }
}
