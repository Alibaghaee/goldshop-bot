<?php

namespace App\Http\Controllers\General;

use App\Filters\NotifyFilters;
use App\Filters\UserFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Notify\NotifyCollection;
use App\Models\General\City;
use App\Models\General\Notify;
use App\Models\General\Package;
use App\Models\General\Province;
use App\Notifications\PortalNotify;
use App\Traits\Controllers\AdminGuard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class NotifyController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the notify.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, NotifyFilters $filters)
    {
        if (request()->expectsJson()) {
            return new NotifyCollection(Notify::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new notify.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model'                  => new Notify,
            'genders'                => config('portal.genders'),
            'fields'                 => config('portal.fields'),
            'provinces'              => Province::asOption(),
            'cities'                 => City::asOption(),
            'payment_filters_status' => config('portal.payment_filters_status'),
            'refund_filters_status'  => config('portal.refund_filters_status'),
            'grades'                 => config('portal.grades'),
            'fields_of_study'        => config('portal.fields_of_study'),
            'packages'               => Package::asOption(),
        ]);
    }

    /**
     * Store a newly created notify in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, UserFilters $filters)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $notify = Notify::create($data);

        $users = User::filter($filters)->get();

        if ($request->has('database') && $request->database == true) {
            Notification::send($users, new PortalNotify($notify));
        }

        if ($request->has('sms') && $request->sms == true) {
            foreach ($users as $user) {
                \Log::info($user->mobile);
                // sms($user->mobile, $request->note);
            }
        }

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('notifies.index')]);
        }

        return redirect()
            ->route('notifies.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Show the form for editing the specified notify.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Notify $notify)
    {
        return view('admin.globals.edit', [
            'model'     => $notify,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified notify in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notify $notify)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $notify->update($data);

        success_flash();
        return response(['redirect' => route('notifys.index')]);
    }

    /**
     * Remove the specified notify from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notify $notify)
    {
        return response([
            'result' => $notify->delete(),
        ]);
    }

    /**
     * Validate the notify store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'title'    => 'required|string|max:255',
            'note'     => 'required',
            'database' => 'nullable|boolean',
            'sms'      => 'nullable|boolean',
        ]);
    }
}
