<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="عنوان"
></i-text>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="module_id" 
    title="امکان"
    :options="{{ $modules }}" 
></i-multiselect>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="image" 
    title="تصویر"
    action="{{ $model->store_uri }}" 
></i-uploader>
