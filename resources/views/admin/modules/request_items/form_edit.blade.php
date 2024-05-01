<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="@lang('Description')"
    value="{{ $model->description }}" 
></i-textarea>