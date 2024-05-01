<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="name" 
    title="@lang('Title')" 
></i-text>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="name" 
    title="@lang('Title')" 
></i-textarea>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="name" 
    title="@lang('Title')" 
></i-checkbox>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="name" 
    title="@lang('Title')" 
    :options="[]" 
></i-multiselect>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="image" 
    title="تصویر"
    action="{{ $model->store_uri }}" 
></i-uploader>

<i-date 
    :form="form" 
    :form_data="form_data" 
    name="name" 
    title="@lang('Title')" 
></i-date>