@extends('user.layouts.master')

@section('title', isset($title) ? __($title) : '')

@section('content')
    <div class="flex flex-wrap h-full" id="app" v-cloak>

        @yield('layout-content')
        
        <flash message="{{ session('flash') }}" level_name="{{ session('level') }}"></flash>
        <user-notification></user-notification>
    </div>
@endsection