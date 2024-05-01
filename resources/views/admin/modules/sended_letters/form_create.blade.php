<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="عنوان"
></i-text>

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="متن نامه"
></i-textarea>

<i-date 
    :form="form" 
    :form_data="form_data" 
    name="date" 
    title="تاریخ نامه"
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
    :value="{{ get_selected_option_from_array($sizes, 2) }}" 
></i-multiselect>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="file" 
    title="فایل"
    action="{{ $model->store_uri }}" 
></i-uploader>

