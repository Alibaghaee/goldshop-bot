<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="توضیحات"
    value="{{ $model->description }}"
></i-textarea>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="image" 
    title="تصویر فاکتور"
    action="{{ $model->store_uri }}"
    value="{{ $model->image }}"
></i-uploader>