@extends('admin.layouts.master')

@section('content')
    <div class="flex flex-wrap h-full" id="app" v-cloak>

        <div class="w-full md:w-2/5 lg:w-1/5 bg-grey-light flex flex-col bg-white" v-show="right_open">
            @include('admin.partials.right_side')
        </div>

        <div class="w-full bg-grey-lighter flex flex-col" :class="[middleSectionWidthClass]">
            @include('admin.partials.top_nav')

            <div class="flex flex-col flex-grow flex-wrap bg-grey-lighter p-4">
                {{-- <div class="flex flex-no-grow -mx-2 mb-4">
                    @foreach (\App\Models\User::allowedToRegisterInfo() as $field)
                    <div class="w-1/3 rahco-center bg-white rounded text-grey-dark leading-normal p-2 mx-2 flex justify-around">
                        <div class="">
                            {{ $field['name'] }}
                            <span class="text-sm text-grey mr-1">{{ $field['percent'] }}%</span>
                        </div>
                        <div class="ltr"><span class="font-bold">
                            {{ $field['used'] }}</span> / <span>{{ $field['capacity'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div> --}}
                <div class="flex-grow bg-white rounded p-4 text-grey-darker leading-loose">
                    @yield('middle')
                </div>

            </div>

        </div>

        <div class="w-full md:w-full lg:w-1/5 bg-white flex flex-col" v-show="left_open">
            {{-- @include('admin.partials.left_side') --}}
        </div>

        <flash message="{{ session('flash') }}" level_name="{{ session('level') }}"></flash>
        <delete-modal></delete-modal>
        <finish-refer-modal></finish-refer-modal>
        <blacklist-send-modal
            blacklist_send_options="{{ isset($blacklist_send_options) ? $blacklist_send_options : '' }}">
        </blacklist-send-modal>
        <blacklist-price-update-modal></blacklist-price-update-modal>
        <location-sender-modal></location-sender-modal>
        <verify-travel-modal></verify-travel-modal>
        <restore-modal></restore-modal>
        <force-delete-modal></force-delete-modal>
    </div>
@endsection
@section('styles')
    {{-- MAP--}}
    <link rel="stylesheet" href="{{asset('leaflet-location-picker/src/leaflet-locationpicker.css')}}"/>

    <link rel="stylesheet" href="//unpkg.com/leaflet@1.1.0/dist/leaflet.css"/>

@endsection
@section('end-scripts')

    @include('scripts.leaflet')
    @include('scripts.geolocation')
@endsection
