<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="name"
    title="نام"
    value="{{ $model->name }}"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="family"
    title="نام خانوادگی"
    value="{{ $model->family }}"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="national_code"
    title="کد ملی"
    value="{{ $model->national_code }}"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="subscrip_code"
    title="کد اشتراک"
    value="{{ $model->subscrip_code }}"

></i-text>


{{-- <i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="username"
    title="نام کاربری"
    value="{{ $model->username }}"
></i-text> --}}

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="email"
    title="ایمیل"
    value="{{ $model->email }}"
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
    title="موبایل"
    value="{{ $model->mobile }}"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="second_mobile"
    title="موبایل دوم"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="phone"
    title="تلفن ثابت"
    value="{{ $model->phone }}"
></i-text>

{{--<i-text--}}
{{--    type="text"--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="emergency_mobile"--}}
{{--    title="تلفن تماس ضروری"--}}
{{--    value="{{ $model->emergency_mobile }}"--}}
{{--></i-text>--}}

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="gender"
    title="جنسیت"
    :options="{{ get_option_from_array($genders) }}"
    :value="{{ get_selected_option_from_array($genders, $model->gender) }}"
></i-multiselect>

{{--<i-multiselect--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="grade"--}}
{{--    title="مقطع تحصیلی"--}}
{{--    :options="{{ get_option_from_array($grades) }}"--}}
{{--    :value="{{ get_selected_option_from_array($grades, $model->grade) }}"--}}
{{--></i-multiselect>--}}

{{--<i-multiselect--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="field_of_study"--}}
{{--    title="رشته تحصیلی"--}}
{{--    :options="{{ get_option_from_array($fields_of_study) }}"--}}
{{--    :value="{{ get_selected_option_from_array($fields_of_study, $model->field_of_study) }}"--}}
{{--></i-multiselect>--}}

{{--<i-multiselect--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="field"--}}
{{--    title="رشته کنکورسراسری"--}}
{{--    :options="{{ get_option_from_array($fields) }}"--}}
{{--    :value="{{ get_selected_option_from_array($fields, $model->field) }}"--}}
{{--></i-multiselect>--}}

<i-province
    :form="form"
    :form_data="form_data"
    :province_value="{{ get_selected_option_from_array($provinces->toArray(), $model->province_id) }}"
    :city_value="{{ get_selected_option_from_array($cities->toArray(), $model->city_id) }}"
></i-province>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="postal_code"
    title="کد پستی"
    value="{{ $model->postal_code }}"
></i-text>

<i-textarea
    :form="form"
    :form_data="form_data"
    name="address"
    title="آدرس"
    value="{{ $model->address }}"
></i-textarea>

{{-- <i-uploader
    :form="form"
    :form_data="form_data"
    name="avatar"
    title="تصویر پروفایل"
    value="{{ $model->avatar }}"
    action="{{ $model->update_uri }}"
    method="put"
></i-uploader> --}}

{{--<i-text--}}
{{--    type="text"--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="iban"--}}
{{--    title="شناسه شبا"--}}
{{--    value="{{ $model->iban }}"--}}
{{--></i-text>--}}
