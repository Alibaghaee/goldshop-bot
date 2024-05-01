@extends('admin.layouts.center')

@section('center-content')
        <login-form-component action="{{ route('admin.password.request') }}" method="post" submit-text="@lang('Reset Password')">
          <template slot="controls" slot-scope="{ form, form_data }">

            <div class="text-grey-dark rounded px-4 text-center text-2xl mb-8">@lang('Reset Password')</div>

            <i-text 
                type="hidden" 
                :form="form" 
                :form_data="form_data" 
                name="token" 
                value="{{ request('token') }}"
            ></i-text>

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

            <i-text 
                type="password" 
                :form="form" 
                :form_data="form_data" 
                name="password_confirmation" 
                title="@lang('Confirm Password')"
            ></i-text>

          </template>

        </login-form-component>
@endsection
