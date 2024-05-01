@extends('admin.layouts.center')

@section('center-content')
    <div class="flex justify-between items-center w-full">
        <div>
            <a href="/admin/login" class="rhc-btn rhc-btn-indigo">@lang('Admin Login')</a>
        </div>
        <div>
            <a href="/login" class="rhc-btn rhc-btn-blue">@lang('User Login')</a>
        </div>
    </div>
@endsection
