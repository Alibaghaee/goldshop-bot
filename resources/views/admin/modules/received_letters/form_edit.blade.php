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
    name="description" 
    title="توضیحات"
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

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="file" 
    title="فایل"
    action="{{ $model->store_uri }}" 
    value="{{ $model->file }}"
    method="put"
></i-uploader>
