<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\General\City;
use App\Models\General\DiscountItem;
use App\Models\General\Form;
use App\Models\General\Package;
use App\Models\General\Province;
use App\Models\General\Purchase;
use App\Rules\NationalCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RegistrationController extends Controller
{
    public function index(Request $request, Package $package)
    {
        session()->regenerate();

        return view(getSiteBladePath('modules.registration.index'), [
            'package'         => $package,
            'genders'         => config('portal.genders'),
            'fields'          => config('portal.fields'),
            'grades'          => config('portal.grades'),
            'fields_of_study' => config('portal.fields_of_study'),
            'provinces'       => Province::asOption(),
            'cities'          => City::asOption(),
            'form'            => $package->form,
        ]);
    }

    public function check_national_code(Request $request)
    {
        $request->merge([
            'national_code' => toLatinDigits($request->get('national_code')),
        ]);

        $request->validate([
            'national_code' => ['required', new NationalCode],
        ]);

        session()->put('national_code', $request->national_code);

        $user                 = User::where('national_code', $request->national_code)->first();
        $national_code_exists = $user && $user->hasPackage() ? true : false;

        return Response([
            'national_code_exists' => $national_code_exists,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $locale, Package $package)
    {
        $request->merge([
            'mobile'           => toLatinDigits($request->get('mobile')),
            'phone'            => toLatinDigits($request->get('phone')),
            'emergency_mobile' => toLatinDigits($request->get('emergency_mobile')),
            'national_code'    => toLatinDigits($request->get('national_code')),
            'postal_code'      => toLatinDigits($request->get('postal_code')),
        ]);

        $data = $request->validate($package->form->validation_rules);

        $data = multiselect_adapter($data);
        session()->put('user_data', $data);
        session()->put('discount_code', Arr::get($data, 'discount_code'));

        return Response([
            'user_data' => $data,
        ]);
    }

    public function confirm(Request $request, $locale, Package $package)
    {
        $request->validate([
            'confirm' => 'required|in:1',
        ]);

        $user_data = session('user_data');

        if (blank($user_data)) {
            return;
        }

        $user = User::firstOrCreate([
            'national_code' => session('national_code'),
        ]);

        // purchase description
        $description = Arr::get($user_data, 'description');
        $user_data   = Arr::except($user_data, ['description']);

        $user->update(Arr::only($user_data, $package->form->fields_name));
        $user->fields()->sync($package->form->fields_id);

        if (Arr::get($user_data, 'payment_type') == 1) {
            $price = $package->pre_payment; // Rial
            $type  = 1; // prepayment
        } else {
            $price = $package->price; // Rial
            $type  = 2; // full payment
        }

        $discount_item = DiscountItem::where('code', Arr::get($user_data, 'discount_code'))->first();

        $payment = Purchase::create([
            'user_id'          => $user->id,
            'package_id'       => $package->id,
            'title'            => $package->title,
            'price'            => checkPriceDiscount($price), // Rial
            'description'      => $description,
            'type'             => $type,
            'discount_price'   => $price - checkPriceDiscount($price), // Rial
            'discount_item_id' => $discount_item ? $discount_item->id : null,
        ]);

        \Auth::loginUsingId($user->id);

        // go to bank
        return response([
            'redirect' => $payment->payment_link,
        ]);
    }
}
