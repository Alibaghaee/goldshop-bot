@extends(getSiteBladePath('layouts.auth-master'))

@section('title', 'ورود به حساب کاربری با رمز یکبار مصرف')

@section('auth-content')

    <div class="flex flex-wrap flex-col-reverse md:flex-row">

        <div class="w-full md:w-2/3 px-4 py-8">
            <div class="w-full max-w-sm mx-auto">

                <div class="text-center md:text-right text-2xl md:text-3xl font-medium text-purple-darkest mb-8 w-full">تایید شماره موبایل</div>

                <login-form-component action="{{ route('otp.login.active.mobile', app()->getLocale()) }}" method="post" submit_text="@lang('Login')">
                  <template slot="controls" slot-scope="{ form, form_data }">

                    <i-text
                        type="text"
                        :form="form"
                        :form_data="form_data"
                        name="code"
                        title="@lang('Code')"
                    ></i-text>

                  </template>
                </login-form-component>
            </div>
        </div>

        <div class="w-full md:w-1/3 rounded-l flex justify-center items-center flex items-baseline" style="background-color: #F3F8FC;">
            <img class="m-auto" src="/image/site/signin.png" alt="signin">
        </div>

    </div>

@endsection
