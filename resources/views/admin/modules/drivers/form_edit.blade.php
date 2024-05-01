<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="first_name"
    title="نام"
    value="{{$model->first_name}}"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="last_name"
    title="نام خانوادگی"
    value="{{$model->last_name}}"

></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="organization_code"
    title="کدسازمانی"
    value="{{$model->organization_code}}"

></i-text>


<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="mobile"
    title="موبایل"
    value="{{$model->mobile}}"

></i-text>
<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="email"
    title="ایمیل"
    value="{{$model->email}}"

></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="password"
    title="پسورد"
    value="{{$model->password}}"

></i-text>

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="status"
    title="وضعیت"
    :options="{{ get_option_from_array(\App\Models\General\Driver::$STATUS_LIST) }}"
    :value="{{ get_selected_option_from_array(\App\Models\General\Driver::$STATUS_LIST,$model->status)  }}"

></i-multiselect>



<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="postal_code"
    title="کدپستی"
    value="{{$model->postal_code}}"

></i-text>

<i-textarea
    :form="form"
    :form_data="form_data"
    name="address"
    title="آدرس"
    value="{{$model->address}}"

></i-textarea>





