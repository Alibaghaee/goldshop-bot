@extends('staff.modules.home.master')

@section('home-master-content')
    <h2 class="text-xl md:text-3xl font-normal mb-6 mt-2 md:mt-16">@lang('Enter the code that was provided to you.')</h2>

    <user-login 
    action="{{ locale_url('user/signin') }}" 
    privacy_policy_url="{{ $privacy_policy_url }}"
    bed_id="{{ request()->id }}"
    ></user-login>

@endsection