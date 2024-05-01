<?php

namespace App\Http\Controllers\General;

use App\Filters\ContactCategoryFilters;
use App\Filters\GroupSmsSenderFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactCategory\ContactCategoryCollection;
use App\Http\Resources\GroupSmsSender\GroupSmsSenderCollection;
use App\Models\General\ContactCategory;
use App\Models\General\ContactNumber;
use App\Models\General\PanelSms;
use App\Models\General\SenderNumber;
use App\Traits\Controllers\AdminGuard;
use App\Models\General\GroupSmsSender;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class GroupSmsSenderController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the group_sms_sender.
     *
     */
    public function index(Request $request, GroupSmsSenderFilters $filters)
    {
        if (request()->expectsJson()) {
            return new GroupSmsSenderCollection(GroupSmsSender::filter($filters)->with('contactCategory', 'senderNumber')->paginate(get_per_page($request)));
        }


        $data['options']['status_list'] = GroupSmsSender::$STATUS_LIST;
        $data['options']['type_list'] = GroupSmsSender::$TYPE_LIST;
        $data['options']['contact_category_list'] = ContactCategory::asGroupOption()->get();
        $data['options']['sender_number_list'] = SenderNumber::asOptionWithType()->get();

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new group_sms_sender.
     *
     */
    public function create(Request $request, ContactCategoryFilters $filters)
    {
        if (request()->expectsJson()) {
            return new ContactCategoryCollection(ContactCategory::published()->filter($filters)->paginate(get_per_page($request)));
        }
        $data['options']['status_list'] = ContactCategory::$STATUS_LIST;

        return view('admin.globals.create', [
            'model' => new GroupSmsSender,
            'status' => GroupSmsSender::$STATUS_LIST,
            'type' => GroupSmsSender::$TYPE_LIST,
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
     * Store a newly created group_sms_sender in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate

        $data = $this->validateStore($request);

        if (is_array(json_decode($data['contactCategory_ids']))) {

            foreach (json_decode($data['contactCategory_ids']) as $contactCategory) {

                // create
                $singleSmsSender = GroupSmsSender::make();
                $singleSmsSender->description = $data['description'];
                $singleSmsSender->sender_number_id = $data['sender_number_id'];
//                $singleSmsSender->type = $data['type'];
                $singleSmsSender->contact_category_id = $contactCategory;
                $singleSmsSender->save();
            }
        }

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('group_sms_senders.index')]);
        }

        return redirect()
            ->route('group_sms_senders.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified group_sms_sender.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(GroupSmsSender $group_sms_sender)
    {
        //
    }

    /**
     * Show the form for editing the specified group_sms_sender.
     *
     * @param int $id
     */
    public function edit(GroupSmsSender $group_sms_sender)
    {
        return redirect()->back();
    }

    /**
     * Update the specified group_sms_sender in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupSmsSender $group_sms_sender)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $group_sms_sender->update($data);

        success_flash();
        return response(['redirect' => route('group_sms_senders.index')]);
    }

    /**
     * Remove the specified group_sms_sender from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupSmsSender $group_sms_sender)
    {
        return response([
            'result' => $group_sms_sender->delete(),
        ]);
    }

    /**
     * Validate the group_sms_sender store request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        $data = $request->validate([
            'description' => 'required',

//            'type' => 'required',
            'contactCategory_ids' => 'required',
            'contactCategory_ids*' => 'required',
            'sender_number_id' => 'required',
        ]);

//        $data['type'] = $data['type']['id'];

        $data['sender_number_id'] = $data['sender_number_id']['id'];

        return $data;

    }

    /**
     * Validate the group_sms_sender update request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateUpdate(Request $request, GroupSmsSender $group_sms_sender)
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
