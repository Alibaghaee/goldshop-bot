<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="عنوان"
    value="{{ $model->title }}"
></i-text>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="module_id" 
    title="امکان"
    :options="{{ $modules }}" 
    :value="{{ $modules->where('id', $model->module_id)->first() }}"
></i-multiselect>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="image" 
    title="تصویر"
    action="{{ $model->store_uri }}" 
    value="{{ $model->image }}"
></i-uploader>
