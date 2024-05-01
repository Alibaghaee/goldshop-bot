@extends(getSiteBladePath('layouts.master'))

@section('title', 'رسید')

@section('content')

    <div class="text-purple-darkest leading-loose h-full flex items-center">
        <div class="container py-16">
            <div class="w-full md:max-w-md mx-auto bg-white rounded shadow-md">

                <div class="w-full p-8 rounded-lg">
                    <div class="leading-loose text-red-dark px-4">
                        <div class="font-bold text-center text-xl bg-grey-lighter border border-red rounded p-2 px-4 -mx-4 mb-2">
                          خطا
                        </div>
                        <flash message="{{ session('flash') }}" level_name="{{ session('level') }}"></flash>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


