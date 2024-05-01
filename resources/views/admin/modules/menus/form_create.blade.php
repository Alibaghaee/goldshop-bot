<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="عنوان"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="name" 
    title="نام"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="link" 
    title="پیوند"
></i-text>

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="توضیحات"
></i-textarea>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="depth" 
    title="عمق"
></i-text>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="menu_type" 
    title="نوع"
    :options="{{ get_option_from_array($menu_types) }}" 
></i-multiselect>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="image" 
    title="تصویر"
    action="{{ $model->store_uri }}" 
></i-uploader>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="removable" 
    title="قابل حذف"
></i-checkbox>

