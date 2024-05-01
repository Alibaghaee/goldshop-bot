<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="عنوان"
></i-text>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="توضیحات"
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

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="file" 
    title="فایل"
    action="{{ $model->store_uri }}" 
></i-uploader>
