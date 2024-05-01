<?php

namespace App\Http\Controllers\General;

use App\Exports\UsersExport;
use App\Filters\UserFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserCollection;
use App\Models\General\City;
use App\Models\General\Package;
use App\Models\General\Province;
use App\Rules\Iban;
use App\Rules\Mobile;
use App\Rules\NationalCode;
use App\Traits\Controllers\AdminGuard;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, UserFilters $filters)
    {

        if (request()->expectsJson()) {
            return new UserCollection(
                User::with(['city', 'province', 'purchases', 'successful_purchases', 'successful_purchases.user', 'refunds'])
                    ->withCount('refunds')
                    ->filter($filters)
                    ->paginate(get_per_page($request))
            );
        }

        $data['options']['genders']                = config('portal.genders');
        $data['options']['fields']                 = config('portal.fields');
        $data['options']['provinces']              = Province::asOption();
        $data['options']['cities']                 = City::asOption();
        $data['options']['payment_filters_status'] = config('portal.payment_filters_status');
        $data['options']['refund_filters_status']  = config('portal.refund_filters_status');
        $data['options']['grades']                 = config('portal.grades');
        $data['options']['fields_of_study']        = config('portal.fields_of_study');
        $data['options']['packages']               = Package::asOption();

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model'           => new User,
            'genders'         => config('portal.genders'),
            'fields_of_study' => config('portal.fields_of_study'),
            'provinces'       => Province::asOption(),
            'cities'          => City::asOption(),
            'grades'          => config('portal.grades'),
            'fields'          => config('portal.fields'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // upload files
        if (is_upload_request($request)) {
            $this->validateAvatar($request);
            return $request->user()->uploadFile($request->avatar, 'images/avatar', true);
        }

        // validate
        $data = $this->validateStore($request);


        // create
        $this->guard()->user()->createUser($data);
        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('users.index')]);
        }

        return redirect()
            ->route('users.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.globals.edit', [
            'model'           => $user,
            'edit_form'       => true,
            'genders'         => config('portal.genders'),
            'fields_of_study' => config('portal.fields_of_study'),
            'provinces'       => Province::asOption(),
            'cities'          => City::where('province_id', $user->province_id)->asOption(),
            'grades'          => config('portal.grades'),
            'fields'          => config('portal.fields'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // upload files
        if (is_upload_request($request)) {
            $this->validateAvatar($request);
            return $request->user()->uploadFile($request->avatar, 'images/avatar', true);
        }

        // validate
        $data = $this->validateUpdate($request, $user);

        // update user
        $result = $user->updateUser($data);

        success_flash();
        return response(['redirect' => route('users.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        return response([
            'result' => $user->delete(),
        ]);
    }

    /**
     * Validate the user store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'name'              => 'required|max:255',
            'family'            => 'required|max:255',
            // 'username'         => 'required|unique:users,username',
            'email'             => 'email|unique:users,email',
            'password'          => 'confirmed|max:255',
            'address'           => 'nullable|string|max:1000',
            'mobile'            => ['nullable', new Mobile],
            'phone'             => 'nullable|numeric',
            'avatar'            => 'nullable|string',
            'emergency_mobile'  => ['nullable', new Mobile],
            'national_code'     => ['nullable', 'numeric'],
            'gender.id'         => 'nullable',
            'grade.id'          => 'nullable',
            'field.id'          => 'nullable',
            'field_of_study.id' => 'nullable',
            'province_id.id'    => 'nullable|exists:provinces,id',
            'city_id.id'        => 'nullable|exists:cities,id',
            'iban'              => ['nullable', 'unique:users,iban', new Iban],
            'postal_code'       => 'nullable|digits:10',
            'subscrip_code'       => 'required',
            'second_mobile'       => 'nullable',

        ]);
    }

    /**
     * Validate the user update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, User $user)
    {
        return $request->validate([
            'name'              => 'required|max:255',
            'family'            => 'required|max:255',
            // 'username'         => "required|unique:users,username,$user->id,id",
            'email'             => "nullable|email|unique:users,email,$user->id,id",
            'password'          => 'confirmed|max:255',
            'address'           => 'nullable|string|max:1000',
            'mobile'            => ['nullable', new Mobile],
            'phone'             => 'nullable|numeric',
            'avatar'            => 'nullable|string',
            'emergency_mobile'  => ['nullable', new Mobile],
            'national_code'     => ['nullable', 'numeric'],
            'gender.id'         => 'nullable',
            'grade.id'          => 'nullable',
            'field.id'          => 'nullable',
            'field_of_study.id' => 'nullable',
            'province_id.id'    => 'nullable|exists:provinces,id',
            'city_id.id'        => 'nullable|exists:cities,id',
            'iban'              => ['nullable', 'unique:users,iban,' . $user->id . ',id', new Iban],
            'postal_code'       => 'nullable|digits:10',
            'subscrip_code'       => 'required',
            'second_mobile'       => 'nullable',
        ]);
    }

    public function validateAvatar(Request $request)
    {
        $request->validate(['avatar' => 'mimes:jpeg,jpg,bmp,png']);
    }

    /**
     * Export as Excel
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Export(Request $request, UserFilters $filters)
    {
        $users = new UserCollection(
            User::with(['city', 'province', 'refunds'])
                ->withCount('refunds')
                ->filter($filters)
                ->get()
        );
        return Excel::download(new UsersExport($users), 'users.xlsx');
    }
}
