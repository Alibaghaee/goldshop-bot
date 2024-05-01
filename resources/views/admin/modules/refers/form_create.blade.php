<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="to_admin_id" 
    title="ارجاع به"
    :options="{{ $admins }}" 
></i-multiselect>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="توضیحات"
></i-textarea>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="file" 
    title="فایل"
    action="{{ $model->store_uri }}" 
></i-uploader>

{{-- <i-checkbox
    :form="form" 
    :form_data="form_data" 
    name="only_visible_for_receiver" 
    title="خصوصی باشد؟"
></i-checkbox> --}}
