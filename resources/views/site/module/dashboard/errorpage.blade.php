@extends('site.layout.master')

@section('content')

    @include('site.shared.static.toast_error')

    <div class="w-full h-full text-right  bg-slate-400">

        <div class="mx-auto  text-center">

            <a href="{{route('site.dashboard.dashboard')}}" class="p-2 hover:bg-slate-500 cursor-pointer  block underline">رفتن به داشبورد</a>



        </div>

    </div>

@endsection
