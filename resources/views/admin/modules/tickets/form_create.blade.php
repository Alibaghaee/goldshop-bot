<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="receiver_id" 
    title="دریافت کننده"
    :options="{{ $admins }}"
></i-multiselect>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="عنوان"
></i-text>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="body" 
    title="متن تیکت"
></i-textarea>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="file" 
    title="فایل"
    action="{{ $model->store_uri }}" 
></i-uploader>
{{-- 
<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="status" 
    title="وضعیت"
    :options="{{ get_option_from_array($status) }}"
></i-multiselect> --}}