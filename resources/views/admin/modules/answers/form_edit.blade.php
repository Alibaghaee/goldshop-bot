<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="body" 
    title="پاسخ"
    value="{{ $model->body }}"
></i-textarea>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="file" 
    title="فایل"
    action="{{ $model->store_uri }}" 
    value="{{ $model->file }}"
></i-uploader>
