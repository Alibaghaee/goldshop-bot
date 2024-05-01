<?php

namespace App\Http\Controllers\General;

use App\Events\VerifyTravelEvent;
use App\Exports\TravelsExport;
use App\Filters\TravelFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Travel\TravelCollection;
use App\Jobs\SendSMSMessageUser;
use App\Models\General\Driver;
use App\Models\General\SmsTemplate;
use App\Traits\Controllers\AdminGuard;
use App\Models\General\Travel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TravelController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the travel.
     *
     * @return  \Illuminate\View\View|TravelCollection
     */
    public function index(Request $request, TravelFilters $filters)
    {

        if (request()->expectsJson()) {

            return new TravelCollection(Travel::with('driver', 'user')
                ->filter($filters)
                ->paginate(get_per_page($request)));
        }


        $data['options']['status_list'] = Travel::$STATUS_LIST;
        $data['options']['reason_list'] = Travel::$TRAVEL_REASON_LIST;
        $data['options']['accompanying_person_list'] = Travel::$ACCOMPANYING_PERSON_LIST;

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new travel.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = \App\Models\User::asOption();
        $driver = Driver::asOption();

        return view('admin.globals.create', [
            'model' => new Travel,
            'users' => $users,
            'driver' => $driver,
            'statusList' => Travel::$STATUS_LIST,
            'reasonList' => Travel::$TRAVEL_REASON_LIST,
            'accompanyingPersonList' => Travel::$ACCOMPANYING_PERSON_LIST,

        ]);
    }

    /**
     * Store a newly created travel in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);
        $data['user_id'] = $data['user_id']['id'];


        if (isset($data['driver_id']) && array_key_exists('id', $data['driver_id'])) {


            $data['driver_id'] = $data['driver_id']['id'];
        } else {

            $data['driver_id'] = null;
        }
        if (isset($data['status']) && array_key_exists('id', $data['status'])) {


            $data['status'] = $data['status']['id'];
        }

        if (isset($data['reason']) && array_key_exists('id', $data['reason'])) {


            $data['reason'] = $data['reason']['name'];
        }

        if (isset($data['accompanying_person']) && array_key_exists('id', $data['accompanying_person'])) {


            $data['accompanying_person'] = $data['accompanying_person']['name'];
        }

        // create
        Travel::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('travels.index')]);
        }

        return redirect()
            ->route('travels.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified travel.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Travel $travel)
    {
        //
    }

    /**
     * Show the form for editing the specified travel.
     *
     * @param int $id
     * @return  \Illuminate\View\View
     */
    public function edit(Travel $travel)
    {
        $users = \App\Models\User::asOption();
        $driver = Driver::asOption();

        return view('admin.globals.edit', [
            'model' => $travel,
            'edit_form' => true,
            'users' => $users,
            'driver' => $driver,
            'statusList' => Travel::$STATUS_LIST,
            'reasonList' => Travel::$TRAVEL_REASON_LIST,
            'accompanyingPersonList' => Travel::$ACCOMPANYING_PERSON_LIST,

        ]);
    }

    /**
     * Update the specified travel in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Travel $travel)
    {
        // validate
        $data = $this->validateStore($request);

        $data['user_id'] = $data['user_id'][0]['id'];
        if (isset($data['driver_id']) && array_key_exists('id', $data['driver_id'])) {


            $data['driver_id'] = $data['driver_id']['id'];
        } else {

            $data['driver_id'] = null;
        }
        if (isset($data['status']) && array_key_exists('id', $data['status'])) {


            $data['status'] = $data['status']['id'];
        }

        if (isset($data['reason']) && array_key_exists('id', $data['reason'])) {


            $data['reason'] = $data['reason']['name'];
        }

        if (isset($data['accompanying_person']) && array_key_exists('id', $data['accompanying_person'])) {


            $data['accompanying_person'] = $data['accompanying_person']['name'];
        }


        // create
        $travel->update($data);

        success_flash();
        return response(['redirect' => route('travels.index')]);
    }

    /**
     * Remove the specified travel from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Travel $travel)
    {
        return response([
            'result' => $travel->delete(),
        ]);
    }


    public function verify(Request $request, Travel $travel)
    {

        if (!$request->has('driver_id.id')) {

            return response([
                'result' => false,
                'message' => 'خطای راننده'
            ]);
        }

        if (!$travel->checkHasUserWalletCharge((int)env('TRAVEL_TICKET_AMOUNT'))) {


            $message = SmsTemplate::getMessageWithTag(SmsTemplate::$WALLET_CHARCH_ERROR, 'سفر شما به دلیل کمبود شارژ تایید نشد.');
            $message = $message . ' کدپیگیری:  ' . $travel->tracking_code;

            SendSMSMessageUser::dispatch($travel->user, $message)->onQueue('send_message_user');

            return response([
                'result' => false,
                'message' => 'خطا , کاربر شارژ کافی برای این سفر را ندارد!!!'
            ]);
        }

        $travel->update([
            'driver_id' => $request->input('driver_id.id'),
            'status' => Travel::$VERIFY
        ]);

        event(new VerifyTravelEvent($travel, env('TRAVEL_TICKET_AMOUNT')));


        return response([
            'result' => true,
            'message' => 'سفر تایید و برای راننده الصاق شد.'
        ]);
    }


    /**
     * Validate the travel store request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'beginning' => 'required',
            'beginning_time' => 'required',
            'destination' => 'required',
            'time_return' => 'required',
            'reason' => 'required',
            'status' => 'required',
            'user_id' => 'required',
            'driver_id' => 'nullable',
            'accompanying_person' => 'required',
        ]);
    }

    /**
     * Validate the travel update request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateUpdate(Request $request, Travel $travel)
    {
        return $request->validate([
            //
        ]);
    }


    /**
     * Export as Excel
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(Request $request, TravelFilters $filters)
    {
        $travels = new TravelCollection(Travel::filter($filters)
            ->with('user', 'driver')
            ->get());

        return Excel::download(
            new TravelsExport($travels),
            'travels__' .
            \Carbon\Carbon::now()->toDateTimeString() .
            '.xlsx');
    }
}
