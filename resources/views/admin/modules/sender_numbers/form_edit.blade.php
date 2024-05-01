<i-text
    :form="form"
    :form_data="form_data"
    name="number"
    title="شماره"
    value="{{$model->number}}"
></i-text>


<i-text
    :form="form"
    :form_data="form_data"
    name="dargah"
    title="درگاه"
    value="{{$model->dargah}}"
></i-text>


<i-multiselect
    :form="form"
    :form_data="form_data"
    name="panel_sms_id"
    title="پنل sms"
    :options="{{json_encode($panels)}}"
    :value="{{ get_selected_option_from_json($panels,$model->panel_sms_id) }}"
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

{{--<i-multiselect--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="dargah"--}}
{{--    title="درگاه"--}}
{{--    :options="{{json_encode($dargah)}}"--}}
{{--    :value="{{ get_selected_option_from_array($dargah,$model->dargah) }}"--}}
{{--></i-multiselect>--}}



