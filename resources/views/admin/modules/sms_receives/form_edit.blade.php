<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="latin" 
    title="فارسی"
    value="{{ $model->field }}" 
></i-text>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="latin" 
    title="فارسی"
    value="{{ $model->field }}" 
></i-textarea>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="latin" 
    title="فارسی"
    :value="{{ $model->field }}" 
></i-checkbox>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="latin" 
    title="فارسی"
    :options="[]" 
    :value="" 
></i-multiselect>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="image" 
    title="تصویر"
    action="{{ $model->store_uri }}" 
    value="{{ $model->field }}"
    method="put"
></i-uploader>

<i-date 
    :form="form" 
    :form_data="form_data" 
    name="latin" 
    title="فارسی"
></i-date>