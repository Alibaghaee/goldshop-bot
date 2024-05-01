<?php

namespace App\Http\Controllers\General;

use App\Filters\AdminProfileFilters;
use App\Filters\NetworkActivityFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminProfile\AdminProfileCollection;

use App\Http\Resources\NetworkActivity\NetworkActivityCollection;
use App\NetworkActivity;
use App\Traits\Controllers\AdminGuard;
use App\Models\General\AdminProfile;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the admin_profile.
     *
     * @return \Illuminate\View\View|AdminProfileCollection
     */
    public function index(Request $request, AdminProfileFilters $filters)
    {
        if (request()->expectsJson()) {

            return new AdminProfileCollection(AdminProfile::filter($filters)
                ->with('admin')
                ->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Display the specified admin_profile.
     *
     * @param AdminProfile $admin_profile
     * @return \Illuminate\View\View|NetworkActivityCollection
     */
    public function show(Request $request, NetworkActivityFilters $filters, AdminProfile $admin_profile)
    {
        if (request()->expectsJson()) {


            return new NetworkActivityCollection(
                NetworkActivity::
                with('networkActivitiable')
                    ->filter($filters)
                    ->where('admin_profile_id', $admin_profile->id)
                    ->orderByDesc('created_at')
                    ->paginate(get_per_page($request)));
        }

        return view('admin.modules.admin_profiles.show_activities'
            , [
                'model' => $admin_profile,
                'page_title' => 'لیست فعالیت های کاربر'
            ]
        );
    }

//    /**
//     * Show the form for creating a new admin_profile.
//     *
//     * @return \Illuminate\View\View
//     */
//    public function create()
//    {
//        return view('admin.globals.create', [
//            'model' => new AdminProfile,
//        ]);
//    }

//    /**
//     * Store a newly created admin_profile in storage.
//     *
//     * @param \Illuminate\Http\Request $request
//     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
//     */
//    public function store(Request $request)
//    {
//        // validate
//        $data = $this->validateStore($request);
//
//        // create
//        AdminProfile::create($data);
//
//        // return response
//        if ($request->wantsJson()) {
//            success_flash();
//            return response(['redirect' => route('admin_profiles.index')]);
//        }
//
//        return redirect()
//            ->route('admin_profiles.index')
//            ->with('flash', 'با موفقیت ثبت شد.');
//    }


//    /**
//     * Show the form for editing the specified admin_profile.
//     *
//     * @param AdminProfile $admin_profile
//     * @return \Illuminate\View\View
//     */
//    public function edit(AdminProfile $admin_profile)
//    {
//        return view('admin.globals.edit', [
//            'model' => $admin_profile,
//            'edit_form' => true,
//        ]);
//    }

//    /**
//     * Update the specified admin_profile in storage.
//     *
//     * @param \Illuminate\Http\Request $request
//     * @param AdminProfile $admin_profile
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, AdminProfile $admin_profile)
//    {
//        // validate
//        $data = $this->validateStore($request);
//
//        // create
//        $admin_profile->update($data);
//
//        success_flash();
//        return response(['redirect' => route('admin_profiles.index')]);
//    }

//    /**
//     * Remove the specified admin_profile from storage.
//     *
//     * @param AdminProfile $admin_profile
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy(AdminProfile $admin_profile)
//    {
//        return response([
//            'result' => $admin_profile->delete(),
//        ]);
//    }
//
//    /**
//     * Validate the admin_profile store request.
//     *
//     * @param \Illuminate\Http\Request $request
//     * @return array
//     */
//    protected function validateStore(Request $request)
//    {
//        return $request->validate([
//            //
//        ]);
//    }
//
//    /**
//     * Validate the admin_profile update request.
//     *
//     * @param \Illuminate\Http\Request $request
//     * @return array
//     */
//    protected function validateUpdate(Request $request, AdminProfile $admin_profile)
//    {
//        return $request->validate([
//            //
//        ]);
//    }
}
