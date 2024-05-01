<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\City;
use App\Models\General\Province;
use App\Models\General\Purchase;
use App\Models\General\Setting;
use App\Rules\Mobile;
use App\Rules\NationalCode;
use App\Rules\Persian;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $profile = auth()->user();

        return view(getSiteBladePath('modules.profile.edit'), [
            'profile'   => $profile,
            'provinces' => Province::asOption(),
            'cities'    => City::asOption(),
            'endpoint'  => route('profile.update', [app()->getLocale(), auth()->id()]),
            'title'     => 'ویرایش اطلاعات کاربری',
        ]);
    }

    /**
     * Update the specified profile in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $profile = auth()->user();

        $data = $this->validateUpdate($request, $profile);

        $profile->update($data);

        success_flash();
        return response(['redirect' => route('profile.edit', [app()->getLocale(), $profile->id])]);
    }

    /**
     * Validate the profile update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, $profile)
    {
        $request->merge([
            // 'mobile'           => toLatinDigits($request->get('mobile')),
            // 'phone'            => toLatinDigits($request->get('phone')),
            // 'emergency_mobile' => toLatinDigits($request->get('emergency_mobile')),
            // 'national_code'    => toLatinDigits($request->get('national_code')),
            // 'postal_code'      => toLatinDigits($request->get('postal_code')),
        ]);

        $data = $request->validate([
            'password'          => 'required|string|min:6|confirmed',
            // 'national_code'     => ['required', 'unique:users', new NationalCode],
            // 'name'              => ['required', 'max:255', new Persian],
            // 'family'            => ['required', 'max:255', new Persian],
            // 'mobile'            => ['required', 'unique:users', new Mobile],
            // 'phone'             => 'nullable|numeric',
            // 'emergency_mobile'  => ['required', new Mobile],
            // 'gender.id'         => 'required|in:0,1',
            // 'province_id.id'    => 'required|exists:provinces,id',
            // 'city_id.id'        => 'required|exists:cities,id',
            // 'grade.id'          => 'required|in:1,2,3,4,5,6,7,8,9,10,11,12,13',
            // 'field_of_study.id' => 'required|in:1,2,3,4,5,6,7,8',
            // 'postal_code'       => 'required|numeric',
            // 'address'           => ['required', 'max:255', new Persian],
        ]);

        $data['password'] = bcrypt($data['password']);
        return multiselect_adapter($data);
    }
}
