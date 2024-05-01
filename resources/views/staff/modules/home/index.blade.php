@extends('staff.modules.home.master')

@section('home-master-content')
    <h2 class="text-xl md:text-3xl font-normal mb-6 mt-2 md:mt-16">@lang('Welcome to Helpchat')</h2>
    <div class="text-sm md:text-base text-grey-lightest">
        @lang('message_home')
    </div>
    <div class="mt-24 mb-4 flex">
        <a href="{{ locale_url('user/signin') }}" class="text-xs md:text-sm bg-indigo-dark block no-undeline no-underline p-3 rounded-full text-center text-white w-1/2 md:w-64 hover:bg-white hover:text-indigo-dark mr-3 font-medium">@lang('I AM A PATIENT')</a>
        <a href="{{ locale_url('signin') }}" class="text-xs md:text-sm bg-indigo-dark block no-undeline no-underline p-3 rounded-full text-center text-white w-1/2 md:w-64 hover:bg-white hover:text-indigo-dark font-medium">@lang('I AM A NURSE')</a>
    </div>
@endsection