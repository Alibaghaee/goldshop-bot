@extends('staff.layouts.layout')

@section('layout-content')
    <div class="bg-purple text-white leading-normal font-normal flex flex-col w-full" style="background-image: url('/image/site/over-layer.png');background-size: cover;">
        {{-- Header --}}
        @include('staff.modules.home.nav')
        
        {{-- Main --}}
        <div class="w-5/6 md:3/4 mx-auto">
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 flex flex-col md:justify-center">

                    @yield('home-master-content')
                    
                </div>
                <div class="flex-col-reverse hidden lg:-mb-16 md:-mb-10 md:flex md:w-1/2 overflow-hidden w-full">
                    <img src="/image/site/img-1.svg" class="" width="667" alt="image">
                </div>
            </div>
            <img src="/image/site/img-1.svg" class="-mb-10 sm:-mb-14 block md:hidden" width="667" alt="image">
        </div>
        {{-- Footer --}}
        @include('staff.modules.home.footer')
    </div>
@endsection