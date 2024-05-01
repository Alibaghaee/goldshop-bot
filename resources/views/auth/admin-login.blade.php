@extends('admin.layouts.center')

@section('center-content')
        <login-form-component action="{{ route('admin.login') }}" method="post" submit_text="@lang('Login')">
          <template slot="controls" slot-scope="{ form, form_data }">

            {{-- <div class="rounded px-4 text-center text-2xl mb-8 bg-green text-white p-3"> @lang('Admin Login') </div> --}}

            <i-text 
                type="text" 
                :form="form" 
                :form_data="form_data" 
                name="email" 
                title="@lang('Email')"
            ></i-text>

            <i-text 
                type="password" 
                :form="form" 
                :form_data="form_data" 
                name="password" 
                title="@lang('Password')"
            ></i-text>

            <i-checkbox 
                type="password" 
                :form="form" 
                :form_data="form_data" 
                name="remember" 
                title="@lang('Remember Me')"
            ></i-checkbox>

            <a class="pr-4 block mb-4" href="{{ route('admin.password.request') }}"> @lang('Forgot Your Password?') </a>

          </template>
        </login-form-component>
@endsection
