<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="receiver_id" 
    title="دریافت کننده"
    :options="{{ $admins }}" 
    :value="{{ $admins->where('id', $model->receiver_id)->first() }}" 
></i-multiselect>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="عنوان"
    value="{{ $model->title }}"
></i-text>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="body" 
    title="متن تیکت"
    value="{{ $model->body }}"
></i-textarea>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="file" 
    title="فایل"
    action="{{ $model->store_uri }}" 
    value="{{ $model->file }}"
></i-uploader>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="status" 
    title="وضعیت"
    :options="{{ get_option_from_array($status) }}"
    :value="{{ get_selected_option_from_array($status, $model->status) }}"
></i-multiselect>
