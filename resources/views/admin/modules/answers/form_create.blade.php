<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="body" 
    title="پاسخ"
></i-textarea>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="file" 
    title="فایل"
    action="{{ $model->store_uri }}" 
></i-uploader>
