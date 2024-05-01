@extends('admin.layouts.master')

@section('content')
    <div class="bg-red flex flex-wrap justify-center items-center" id="app" v-cloak>
        <div class="w-full md:w-2/5 flex items-center flex-col p-8 bg-white text-grey-darker rounded shadow">

            @yield('center-content')

            <flash message="{{ session('flash') }}" level="{{ session('level') }}"></flash>
        </div>

        @include('admin.layouts.credit-footer')
    </div>
@endsection
