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
    name="type" 
    title="نوع"
    :options="{{ get_option_from_array($educational_content_types) }}" 
    :value="{{ get_selected_option_from_array($educational_content_types, $model->type) }}"
></i-multiselect>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="file" 
    title="فایل"
    action="{{ $model->store_uri }}" 
    value="{{ $model->file }}"
></i-uploader>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="cover" 
    title="کاور"
    action="{{ $model->store_uri }}" 
    value="{{ $model->cover }}"
></i-uploader>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="active" 
    title="وضعیت نمایش"
    :value="{{ $model->active }}"
></i-checkbox>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="convert" 
    title="انجام عملیات تبدیل"
></i-checkbox>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="video_sd" 
    title="ویدئو کیفیت متوسط"
    action="{{ $model->store_uri }}" 
></i-uploader>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="video_hd"
    title="ویدئو کیفیت خوب"
    action="{{ $model->store_uri }}" 
></i-uploader>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="video_fhd" 
    title="ویدئو کیفیت عالی"
    action="{{ $model->store_uri }}" 
></i-uploader>