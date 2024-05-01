<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="title"
    title="عنوان"
    value="{{$model->title}}"
></i-text>


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
    name="panelSms"
    title="پنل sms"
    :options="{{json_encode($panelSms)}}"
    :value="{{ get_selected_option_from_json($panelSms,$model->panel_sms_id) }}"
></i-multiselect>


