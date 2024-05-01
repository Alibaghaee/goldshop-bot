<i-text
    :form="form"
    :form_data="form_data"
    name="number"
    title="شماره"
></i-text>


<i-multiselect
    :form="form"
    :form_data="form_data"
    name="panel_sms_id"
    title="پنل sms"
    :options="{{json_encode($panels)}}"
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

{{--<i-multiselect--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="dargah"--}}
{{--    title="درگاه"--}}
{{--    :options="{{json_encode($dargah)}}"--}}
{{--></i-multiselect>--}}



