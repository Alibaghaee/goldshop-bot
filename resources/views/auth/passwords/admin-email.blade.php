@extends('admin.layouts.center')

@section('center-content')
        <login-form-component action="{{ route('admin.password.email') }}" method="post" submit_text="@lang('Send Password Reset Link')">
          <template slot="controls" slot-scope="{ form, form_data }">

            <div class="text-grey-dark rounded px-4 text-center text-2xl mb-8">{{ __('Reset Password') }}</div>

            <i-text 
                type="text" 
                :form="form" 
                :form_data="form_data" 
                name="email" 
                title="@lang('Email')"
            ></i-text>

          </template>
        </login-form-component>
@endsection
