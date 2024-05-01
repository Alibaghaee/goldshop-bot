<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\General\City;
use App\Models\General\DiscountItem;
use App\Models\General\Form;
use App\Models\General\Package;
use App\Models\General\Province;
use App\Models\General\Purchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class FillOutProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        if (auth()->user()->payablePrice($package->id) <= 0) {
            return redirect($package->show_url);
        }

        $uncomplete_fields = auth()->user()->uncompleteFields($package->form);
        $user              = User::with((['city', 'province']))->find(auth()->id());

        return view(getSiteBladePath('modules.fill_out_profile.edit'), [
            'package'                   => $package,
            'genders'                   => config('portal.genders'),
            'fields'                    => config('portal.fields'),
            'grades'                    => config('portal.grades'),
            'fields_of_study'           => config('portal.fields_of_study'),
            'provinces'                 => Province::asOption(),
            'cities'                    => City::asOption(),
            'form'                      => $package->form,
            'uncomplete_fields'         => $uncomplete_fields,
            'user'                      => $user,
            'can_pre_payment'           => $user->canPrePayment($package),
            'can_full_payment'          => $user->canFullPayment($package),
            'can_supplementary_payment' => $user->canSupplementaryPayment($package),
        ]);
        // show update form according to package uncompelete fields
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale, Package $package)
    {
        $request->merge([
            'mobile'           => toLatinDigits($request->get('mobile')),
            'phone'            => toLatinDigits($request->get('phone')),
            'emergency_mobile' => toLatinDigits($request->get('emergency_mobile')),
            'national_code'    => toLatinDigits($request->get('national_code')),
            'postal_code'      => toLatinDigits($request->get('postal_code')),
        ]);

        $data = $request->validate($package->form->uncomplete_fields_validation_rules);

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

        // purchase description
        $description = Arr::pull($user_data, 'description');

        if (!blank($user_data)) {
            auth()->user()->update(Arr::only($user_data, $package->form->user_uncomplete_fields_name));
            auth()->user()->fields()->attach($package->form->user_uncomplete_fields_id);
        }

        $payment_type  = Arr::get($user_data, 'payment_type');
        $price         = Arr::get($package->prices(), $payment_type);
        $discount_item = DiscountItem::where('code', Arr::get($user_data, 'discount_code'))->first();

        $payment = Purchase::create([
            'user_id'          => auth()->id(),
            'package_id'       => $package->id,
            'title'            => $package->title,
            'price'            => checkPriceDiscount($price), // Rial
            'description'      => $description,
            'type'             => $payment_type,
            'discount_price'   => $price - checkPriceDiscount($price), // Rial
            'discount_item_id' => optional($discount_item)->id,
        ]);

        // go to bank
        return response([
            'redirect' => $payment->payment_link,
        ]);
    }
}
