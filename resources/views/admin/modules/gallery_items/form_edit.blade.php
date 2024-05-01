<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="عنوان"
    value="{{ $model->title }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="link" 
    title="لینک"
    value="{{ $model->link }}"
></i-text>

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="توضیحات"
    value="{{ $model->description }}"
></i-textarea>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="active" 
    title="وضعیت نمایش"
    :value="{{ $model->active }}" 
></i-checkbox>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="image" 
    title="تصویر"
    action="{{ $model->store_uri }}" 
    value="{{ $model->image }}"
></i-uploader>
