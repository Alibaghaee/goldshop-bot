<i-text
    :form="form"
    :form_data="form_data"
    name="username"
    title="نام کاربری"
    value="{{$model->username}}"
></i-text>

<i-text
    :form="form"
    :form_data="form_data"
    name="password"
    title="رمز عبور"
></i-text>


<i-multiselect
    :form="form"
    :form_data="form_data"
    name="domain"
    title="دامنه"
    :options="{{json_encode($domain)}}"
    :value="{{ get_selected_option_from_array($domain,$model->domain) }}"
></i-multiselect>


<i-multiselect
    :form="form"
    :form_data="form_data"
    name="status"
    title="وضعیت"
    :options="{{json_encode($status)}}"
    :value="{{ get_selected_option_from_array($status,$model->status) }}"
></i-multiselect>

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="type"
    title="نوع"
    :options="{{json_encode($type)}}"
    :value="{{ get_selected_option_from_array($type,$model->type) }}"
></i-multiselect>





