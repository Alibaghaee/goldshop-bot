<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\General\City;
use App\Models\General\Pay;
use App\Models\General\Province;
use App\Models\General\Setting;
use App\Rules\NationalCode;
use App\Rules\Persian;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PayController extends Controller
{
    public function index(Request $request)
    {
        session()->regenerate();

        $descriptions = [
            'one' => setting('31'),
        ];

        return view(getSiteBladePath('modules.pay.index'), [
            'genders'          => config('portal.genders'),
            'grades'           => config('portal.grades'),
            'fields_of_study'  => config('portal.fields_of_study'),
            'provinces'        => Province::asOption(),
            'cities'           => City::asOption(),
            'descriptions'     => $descriptions,
            'payment_subjects' => config('portal.payment_subjects'),
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
        $request->merge([
            'mobile'           => toLatinDigits($request->get('mobile')),
            'phone'            => toLatinDigits($request->get('phone')),
            'emergency_mobile' => toLatinDigits($request->get('emergency_mobile')),
            'national_code'    => toLatinDigits($request->get('national_code')),
            'price'            => toLatinDigits($request->get('price')),
        ]);

        $rules = $this->validationRules();

        $data = $request->validate($rules);
        $data = multiselect_adapter($data);

        $pay = Pay::create([
            'national_code'    => Arr::get($data, 'national_code'),
            'name'             => Arr::get($data, 'name'),
            'family'           => Arr::get($data, 'family'),
            'mobile'           => Arr::get($data, 'mobile'),
            'phone'            => Arr::get($data, 'phone'),
            'emergency_mobile' => Arr::get($data, 'emergency_mobile'),
            'gender'           => Arr::get($data, 'gender'),
            'province_id'      => Arr::get($data, 'province_id'),
            'city_id'          => Arr::get($data, 'city_id'),
            'grade'            => Arr::get($data, 'grade'),
            'field_of_study'   => Arr::get($data, 'field_of_study'),
            'payment_subject'  => Arr::get($data, 'payment_subject'),
            'title'            => Arr::get($data, 'payment_subject'),
            'description'      => Arr::get($data, 'payment_description'),
            'price'            => Arr::get($data, 'price'), // Rial
        ]);

        // go to bank
        return response(['redirect' => '/' . app()->getLocale() . '/pay/bank/request?id=' . $pay->id]);

    }

    public function validationRules()
    {
        return [
            'national_code'       => ['required', 'numeric', new NationalCode],
            'name'                => ['required', 'max:255', new Persian],
            'family'              => ['required', 'max:255', new Persian],
            'mobile'              => 'required|regex:/^09[0-9]{9}$/i',
            'phone'               => 'nullable|numeric',
            'emergency_mobile'    => 'required|regex:/^09[0-9]{9}$/i',
            'gender.id'           => 'required|in:0,1',
            'province_id.id'      => 'required|exists:provinces,id',
            'city_id.id'          => 'required|exists:cities,id',
            'grade.id'            => 'required|in:1,2,3,4,5,6,7,8,9,10,11,12,13',
            'field_of_study.id'   => 'required|in:1,2,3,4,5,6,7,8',
            'payment_subject.id'  => 'required|in:1,2,3,4,5,6',
            'payment_description' => ['required_if:payment_subject.id,6', new Persian, 'string', 'max:100', 'nullable'],
            'price'               => 'required|integer',
        ];
    }
}
