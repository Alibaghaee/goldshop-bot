@extends(getSiteBladePath('layouts.auth-master'))

@section('title', setting(13))

@section('auth-content')

    <div class="flex flex-wrap">

        <div class="w-full md:w-2/3 px-4 py-8">
            <custom_register_form
                action="{{ route('registration.check_national_code', app()->getLocale()) }}"
                method="post"
                class="md:px-8 mx-auto"
                :genders="{{ json_encode($genders) }}"
                {{-- :grades="{{ json_encode($grades) }}"  --}}
                :fields_of_study="{{ json_encode($fields_of_study) }}"
                :fields="{{ json_encode($fields) }}"
                {{-- :provinces="{{ json_encode($provinces) }}" --}}
                {{-- :cities="{{ json_encode($cities) }}" --}}
                :package="{{ json_encode($package) }}"
            >
                <template slot="inputs" slot-scope="{ form, form_data }">

                    @include('site/fa/modules/registration/form', compact($form))

                </template>
            </custom_register_form>
        </div>

        <div class="w-full md:w-1/3 rounded-l flex justify-center items-center flex items-baseline">
            <img src="{{ $package->image }}" alt="signup" class="w-full">
        </div>

    </div>

@endsection


@section('end-scripts')
    <script></script>
@endsection
