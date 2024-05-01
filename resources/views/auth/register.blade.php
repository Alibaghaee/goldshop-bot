@extends('admin.layouts.center')

@section('center-content')
        <login-form-component action="{{ route('register',app()->getLocale()) }}" method="post" submit_text="@lang('Register')">

            <template slot="controls" slot-scope="{ form, form_data }">

            <div class="text-grey-dark rounded px-4 text-center text-2xl mb-8">@lang('Register')</div>
            <i-text
                type="text"
                :form="form"
                :form_data="form_data"
                name="name"
                title="@lang('Name')"
            ></i-text>

            <i-text
                type="text"
                :form="form"
                :form_data="form_data"
                name="mobile"
                title="موبایل"
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
                <a class="block mb-4" href="{{ route('login', app()->getLocale()) }}">ثبت نام کرده اید؟روی این لینک کلیک کنید.</a>

          </template>
        </login-form-component>
@endsection
