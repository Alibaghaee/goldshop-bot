<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="latin" 
    title="فارسی"
></i-text>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="latin" 
    title="فارسی"
></i-textarea>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="latin" 
    title="فارسی"
></i-checkbox>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="latin" 
    title="فارسی"
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
    name="latin" 
    title="فارسی"
></i-date>