<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="assigned_to_admin_id" 
    title="دریافت کننده"
    :options="{{ $admins }}" 
    :value="{{ $admins->where('id', $model->assigned_to_admin_id)->first() }}" 
></i-multiselect>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="فعالیت های محوله"
    value="{{ $model->description }}" 
></i-textarea>

<i-date 
    :form="form" 
    :form_data="form_data" 
    name="start_date" 
    title="تاریخ"
    value="{{ $model->start_date }}" 
    display_format="dddd jDD jMMMM jYYYY - ساعت HH:mm"
></i-date>

<i-date 
    :form="form" 
    :form_data="form_data" 
    name="deadline" 
    title="مهلت"
    value="{{ $model->deadline }}" 
    display_format="dddd jDD jMMMM jYYYY - ساعت HH:mm"
></i-date>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="status" 
    title="وضعیت"
    :options="{{ get_option_from_array($status) }}" 
    :value="{{ get_selected_option_from_array($status, $model->status) }}"
></i-multiselect>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="file" 
    title="فایل"
    action="{{ $model->store_uri }}" 
    value="{{ $model->file }}"
></i-uploader>
