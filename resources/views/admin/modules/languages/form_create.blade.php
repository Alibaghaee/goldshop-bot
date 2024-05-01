<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="@lang('Title')" 
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="key" 
    title="Key"
></i-text>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="json" 
    title="Data"
></i-textarea>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="active" 
    title="Active"
></i-checkbox>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="icon" 
    title="Icon"
    action="{{ $model->store_uri }}" 
></i-uploader>