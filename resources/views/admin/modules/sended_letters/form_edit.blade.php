<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="عنوان"
    value="{{ $model->title }}"
></i-text>

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="متن نامه"
    value="{{ $model->description }}"
></i-textarea>

<i-date 
    :form="form" 
    :form_data="form_data" 
    name="date" 
    title="تاریخ نامه"
    value="{{ $model->date }}"
    format="YYYY-MM-DD"
    display_format="jYYYY/jMM/jDD"
    type="date"
></i-date>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="size" 
    title="اندازه نامه"
    :options="{{ get_option_from_array($sizes) }}" 
    :value="{{ get_selected_option_from_array($sizes, $model->size) }}" 
></i-multiselect>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="file" 
    title="فایل"
    action="{{ $model->store_uri }}" 
    value="{{ $model->file }}"
    method="put"
></i-uploader>
