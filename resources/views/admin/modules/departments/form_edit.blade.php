<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="فارسی"
    value="{{ $model->title }}" 
></i-text>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="توضیحات"
    value="{{ $model->description }}" 
></i-textarea>