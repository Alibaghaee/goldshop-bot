@extends('staff.layouts.layout')

@section('layout-content')
        
    <div class="h-full bg-grey-lighter w-full text-grey-dark">

        @include('staff.modules.dashboard.nav')

        @yield('dashboard-content')
        
    </div>
        
@endsection