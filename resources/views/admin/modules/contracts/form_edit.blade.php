<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="customer_id" 
    title="مشتری"
    :options="{{ $customers }}" 
    :value="{{ get_selected_option_from_array($customers->toArray(), $model->customer_id) }}"
></i-multiselect>

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
    value="{{ $model->body }}"
></i-textarea>

@include('admin.modules.contracts.tags_help')

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="توضیحات"
    value="{{ $model->description }}"
></i-textarea>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="is_pattern" 
    title="به عنوان الگو"
    :value="{{ $model->is_pattern }}"
></i-checkbox>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="file" 
    title="فایل"
    action="{{ $model->store_uri }}" 
    value="{{ $model->file }}"
></i-uploader>
