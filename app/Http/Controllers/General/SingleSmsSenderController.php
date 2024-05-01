<?php

namespace App\Http\Controllers\General;

use App\Filters\ContactNumberFilters;
use App\Filters\SingleSmsSenderFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactNumber\ContactNumberCollection;
use App\Http\Resources\NewsLetter\NewsLetterUserResourceCollection;
use App\Http\Resources\SingleSmsSender\SingleSmsSenderCollection;
use App\Models\General\ContactNumber;
use App\Models\General\PanelSms;
use App\Models\General\SenderNumber;
use App\Traits\Controllers\AdminGuard;
use App\Models\General\SingleSmsSender;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SingleSmsSenderController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the single_sms_sender.
     *
     */
    public function index(Request $request, SingleSmsSenderFilters $filters)
    {
        if (request()->expectsJson()) {
            return new SingleSmsSenderCollection(SingleSmsSender::filter($filters)
                ->with('contactNumber', 'senderNumber')
                ->paginate(get_per_page($request)));
        }
        $data['options']['status_list'] = SingleSmsSender::$STATUS_LIST;
        $data['options']['type_list'] = SingleSmsSender::$TYPE_LIST;
        $data['options']['contact_number_list'] = ContactNumber::asGroupOption()->get();
        $data['options']['sender_number_list'] = SenderNumber::asOptionWithType()->get();

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new single_sms_sender.
     *
     */
    public function create(Request $request, ContactNumberFilters $filters)
    {
        if (request()->expectsJson()) {
            return new ContactNumberCollection(ContactNumber::published()->filter($filters)->with('contactCategory')->paginate(get_per_page($request)));
        }
        $data['options']['status_list'] = ContactNumber::$STATUS_LIST;

        return view('admin.globals.create', [
            'model' => new SingleSmsSender,
            'status' => SingleSmsSender::$STATUS_LIST,
            'type' => SingleSmsSender::$TYPE_LIST,
            'senderNumbers' => SenderNumber::published()
                ->ownerPanel()
                ->publishedPanel()
                ->asOptionWithType()->get(),

            'senderNumbersWithoutType' => SenderNumber::published()
                ->ownerPanel()
                ->publishedPanel()
                ->asOption()->get(),
            'data' => $data
        ]);
    }

    /**
     * Store a newly created single_sms_sender in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        if (is_array(json_decode($data['contactNumber_ids']))) {

            foreach (json_decode($data['contactNumber_ids']) as $contactNumber) {

                // create
                $singleSmsSender = SingleSmsSender::make();
                $singleSmsSender->description = $data['description'];
                $singleSmsSender->sender_number_id = $data['sender_number_id'];
//                $singleSmsSender->type = $data['type'];
                $singleSmsSender->contact_number_id = $contactNumber;
                $singleSmsSender->save();
            }
        }
        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('single_sms_senders.index')]);
        }

        return redirect()
            ->route('single_sms_senders.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified single_sms_sender.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(SingleSmsSender $single_sms_sender)
    {
        //
    }

    /**
     * Show the form for editing the specified single_sms_sender.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SingleSmsSender $single_sms_sender)
    {

        return redirect()->back();
    }

    /**
     * Update the specified single_sms_sender in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SingleSmsSender $single_sms_sender)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $single_sms_sender->update($data);

        success_flash();
        return response(['redirect' => route('single_sms_senders.index')]);
    }

    /**
     * Remove the specified single_sms_sender from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SingleSmsSender $single_sms_sender)
    {
        return response([
            'result' => $single_sms_sender->delete(),
        ]);
    }

    /**
     * Validate the single_sms_sender store request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateStore(Request $request)
    {

        $data = $request->validate([
            'description' => 'required',

//            'type' => 'required',
            'contactNumber_ids' => 'required',
            'contactNumber_ids*' => 'required',
            'sender_number_id' => 'required',
        ]);

//        $data['type'] = $data['type']['id'];

        $data['sender_number_id'] = $data['sender_number_id']['id'];

        return $data;
    }

    /**
     * Validate the single_sms_sender update request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateUpdate(Request $request, SingleSmsSender $single_sms_sender)
    {
        return $request->validate([
            //
        ]);
    }


    public function getBalance(Request $request)
    {

        $data = $request->validate([
            'sender_number_id' => 'required',
        ]);

        $panelSms = PanelSms::whereHas('senderNumbers', function (Builder $query) use ($data) {

            $query->where('id', $data['sender_number_id']);
        })->firstOrFail();

        $config['username'] = $panelSms->username;
        $config['password'] = $panelSms->decrypt_password;
        $config['domain'] = $panelSms->domain;
        $response = balancePanel($config);

        return response([
            'charge' => (int)$response
        ]);
    }
}
