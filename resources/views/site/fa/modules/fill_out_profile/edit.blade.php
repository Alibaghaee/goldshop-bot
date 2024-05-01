@extends(getSiteBladePath('layouts.auth-master'))

@section('title', setting(13))

@section('auth-content')
    
    <div class="flex flex-wrap">

        <div class="w-full md:w-2/3 px-4 py-8">
            <uncomplete_fields_form 
            action="{{ route('registration.check_national_code', app()->getLocale()) }}" 
            method="post" 
            class="md:px-8 mx-auto" 
            :genders="{{ json_encode($genders) }}" 
            :grades="{{ json_encode($grades) }}" 
            :fields_of_study="{{ json_encode($fields_of_study) }}" 
            :fields="{{ json_encode($fields) }}"
            :provinces="{{ json_encode($provinces) }}"
            :cities="{{ json_encode($cities) }}"
            :package="{{ json_encode($package) }}"
            :user="{{ json_encode($user) }}"
            :can_pre_payment="{{ json_encode($can_pre_payment) }}"
            :can_full_payment="{{ json_encode($can_full_payment) }}"
            :can_supplementary_payment="{{ json_encode($can_supplementary_payment) }}"
            >
                <template slot="inputs" slot-scope="{ form, form_data }">

                  @include(getSiteBladePath('modules.fill_out_profile.form'), compact($form))

                </template>
            </uncomplete_fields_form>
        </div>

        <div class="w-full md:w-1/3 rounded-l flex justify-center items-center flex items-baseline">
            <img src="{{ $package->image }}" alt="signup" class="w-full">
        </div>

    </div>

@endsection