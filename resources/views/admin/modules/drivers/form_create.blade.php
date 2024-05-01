<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="first_name"
    title="نام"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="last_name"
    title="نام خانوادگی"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="organization_code"
    title="کدسازمانی"
></i-text>


<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="mobile"
    title="موبایل"
></i-text>
<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="email"
    title="ایمیل"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="password"
    title="پسورد"
></i-text>

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="status"
    title="وضعیت"
    :options="{{ get_option_from_array(\App\Models\General\Driver::$STATUS_LIST) }}"
></i-multiselect>



<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="postal_code"
    title="کدپستی"
></i-text>

<i-textarea
    :form="form"
    :form_data="form_data"
    name="address"
    title="آدرس"
></i-textarea>





