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
    name="type" 
    title="نوع"
    :options="{{ get_option_from_array($educational_content_types) }}" 
></i-multiselect>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="file" 
    title="فایل"
    action="{{ $model->store_uri }}" 
></i-uploader>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="cover" 
    title="کاور"
    action="{{ $model->store_uri }}" 
></i-uploader>


<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="active" 
    title="وضعیت نمایش"
></i-checkbox>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="convert" 
    title="انجام عملیات تبدیل"
></i-checkbox>