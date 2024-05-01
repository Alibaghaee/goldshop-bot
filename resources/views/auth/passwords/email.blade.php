@extends(getSiteBladePath('layouts.auth-master'))

@section('title', 'ورود')

@section('auth-content')
        
    <div class="flex flex-wrap flex-col-reverse md:flex-row">

        <div class="w-full md:w-2/3 px-4 py-8">
            <div class="w-full max-w-sm mx-auto">

                <div class="text-center md:text-right text-2xl md:text-3xl font-medium text-purple-darkest mb-8 w-full">{{ __('Reset Password') }}</div>

                <login-form-component action="{{ route('password.email', app()->getLocale()) }}" method="post" submit_text="@lang('Send Password Reset Link')">
                  <template slot="controls" slot-scope="{ form, form_data }">

                    <i-text 
                        type="text" 
                        :form="form" 
                        :form_data="form_data" 
                        name="email" 
                        title="@lang('Email')"
                    ></i-text>

                  </template>
                </login-form-component>
            </div>
        </div>

        <div class="w-full md:w-1/3 bg-purple-dark rounded-t md:rounded-t-none md:rounded-l flex justify-center items-center">
            <div class="text-5xl text-white">{{ __('Reset Password') }}</div>
        </div>

    </div>

@endsection
