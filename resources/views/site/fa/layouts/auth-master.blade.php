@extends(getSiteBladePath('layouts.master'))

@section('content')
    <div class="text-purple-darkest leading-loose h-full flex items-center">
        <div class="container py-4 md:py-16">
            <div class="w-full md:max-w-5xl mx-auto bg-white rounded shadow border border-grey-lightest">

                @yield('auth-content')

            </div>
{{--            <div class="w-full md:max-w-5xl mx-auto text-center p-4 mt-4">{{ setting(config('portal.setting_id.contact_info')) }}</div>--}}
        </div>
    </div>
@endsection
