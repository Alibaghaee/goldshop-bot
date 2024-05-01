<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="assigned_to_admin_id" 
    title="دریافت کننده"
    :options="{{ $admins }}" 
></i-multiselect>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="فعالیت های محوله"
></i-textarea>

<i-date 
    :form="form" 
    :form_data="form_data" 
    name="start_date" 
    title="تاریخ"
    display_format="dddd jDD jMMMM jYYYY - ساعت HH:mm"
></i-date>

<i-date 
    :form="form" 
    :form_data="form_data" 
    name="deadline" 
    title="مهلت"
    display_format="dddd jDD jMMMM jYYYY - ساعت HH:mm"
></i-date>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="file" 
    title="فایل"
    action="{{ $model->store_uri }}" 
></i-uploader>