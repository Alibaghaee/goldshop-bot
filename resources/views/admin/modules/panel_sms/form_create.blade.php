<i-text
    :form="form"
    :form_data="form_data"
    name="username"
    title="نام کاربری"
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
></i-multiselect>

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="status"
    title="وضعیت"
    :options="{{json_encode($status)}}"
></i-multiselect>

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="type"
    title="نوع"
    :options="{{json_encode($type)}}"
></i-multiselect>





