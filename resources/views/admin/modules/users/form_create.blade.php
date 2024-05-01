<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="name"
    title="نام"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="family"
    title="نام خانوادگی"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="national_code"
    title="کد ملی"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="subscrip_code"
    title="کد اشتراک"
></i-text>

{{-- <i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="username"
    title="نام کاربری"
></i-text> --}}

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="email"
    title="ایمیل"
></i-text>

<i-text
    type="password"
    :form="form"
    :form_data="form_data"
    name="password"
    title="گذرواژه"
></i-text>

<i-text
    type="password"
    :form="form"
    :form_data="form_data"
    name="password_confirmation"
    title="تکرار گذرواژه"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="mobile"
    title="تلفن همراه"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="phone"
    title="تلفن ثابت"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="second_mobile"
    title="موبایل دوم"
></i-text>

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="gender"
    title="جنسیت"
    :options="{{ get_option_from_array($genders) }}"
></i-multiselect>

{{--<i-multiselect--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="grade"--}}
{{--    title="مقطع تحصیلی"--}}
{{--    :options="{{ get_option_from_array($grades) }}"--}}
{{--></i-multiselect>--}}

{{--<i-multiselect--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="field_of_study"--}}
{{--    title="رشته تحصیلی"--}}
{{--    :options="{{ get_option_from_array($fields_of_study) }}"--}}
{{--></i-multiselect>--}}

{{--<i-multiselect--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="field"--}}
{{--    title="رشته کنکورسراسری"--}}
{{--    :options="{{ get_option_from_array($fields) }}"--}}
{{--></i-multiselect>--}}

<i-province
    :form="form"
    :form_data="form_data"
></i-province>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="postal_code"
    title="کد پستی"
></i-text>

<i-textarea
    :form="form"
    :form_data="form_data"
    name="address"
    title="آدرس"
></i-textarea>

{{-- <i-uploader
    :form="form"
    :form_data="form_data"
    name="avatar"
    title="تصویر پروفایل"
    action="/users/users"
></i-uploader> --}}

{{--<i-text--}}
{{--    type="text"--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="iban"--}}
{{--    title="شناسه شبا"--}}
{{--></i-text>--}}
