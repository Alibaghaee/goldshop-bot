<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="@lang('Title')" 
    value="{{ $model->title }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="key" 
    title="Key"
    value="{{ $model->key }}"
></i-text>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="json" 
    title="Data"
    value="{{ $model->data }}"
></i-textarea>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="active" 
    title="Active"
    :value="{{ $model->active }}"
></i-checkbox>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="icon" 
    title="Icon"
    action="{{ $model->store_uri }}" 
    value="{{ $model->icon }}"
></i-uploader>