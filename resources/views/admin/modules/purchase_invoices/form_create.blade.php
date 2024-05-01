<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="توضیحات"
></i-textarea>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="image" 
    title="تصویر فاکتور"
    action="{{ $model->store_uri }}" 
></i-uploader>