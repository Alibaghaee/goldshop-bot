<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="title"
    title="عنوان"
></i-text>


<i-multiselect
    :form="form"
    :form_data="form_data"
    name="status"
    title="وضعیت"
    :options="{{$status}}"
></i-multiselect>

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="panelSms"
    title="پنل sms"
    :options="{{json_encode($panelSms)}}"
></i-multiselect>


