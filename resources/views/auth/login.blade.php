@extends(getSiteBladePath('layouts.auth-master'))

@section('title', 'ورود')

@section('auth-content')

    <div class="flex flex-wrap flex-col-reverse md:flex-row">

        <div class="w-full md:w-2/3 px-4 py-8">
            <div class="w-full max-w-sm mx-auto">

                <div class="text-center md:text-right text-2xl md:text-3xl font-medium text-purple-darkest mb-8 w-full">ورود به حساب کاربری</div>

                <login-form-component action="{{ route('login', app()->getLocale()) }}" method="post" submit_text="@lang('Login')">
                  <template slot="controls" slot-scope="{ form, form_data }">

                    <i-text
                        type="text"
                        :form="form"
                        :form_data="form_data"
                        name="mobile"
                        title="@lang('mobile')"
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

                    <a class="block mb-4" href="{{ route('otp.request', app()->getLocale()) }}"> @lang('Forgot Your Password?') </a>
                    <a class="block mb-4" href="{{ route('register', app()->getLocale()) }}">ثبت نام نکرده اید؟روی این لینک کلیک کنید.</a>


                  </template>
                </login-form-component>
            </div>
        </div>

        <div class="w-full md:w-1/3 rounded-l flex justify-center items-center flex items-baseline" style="background-color: #F3F8FC;">
            <img class="m-auto" src="{{ asset('image/admin/logo.png') }}" alt="signin">
        </div>

    </div>

@endsection
