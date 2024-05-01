<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="customer_id" 
    title="مشتری"
    :options="{{ $customers }}" 
></i-multiselect>

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
    name="xxxx" 
    title="الگو"
    :options="{{ $patterns }}" 
></i-multiselect>

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="body" 
    title="متن قرارداد"
></i-textarea>

@include('admin.modules.contracts.tags_help')

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="توضیحات"
></i-textarea>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="is_pattern" 
    title="به عنوان الگو"
></i-checkbox>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="file" 
    title="فایل"
    action="{{ $model->store_uri }}" 
></i-uploader>
