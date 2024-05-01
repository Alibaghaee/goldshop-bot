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
    name="name" 
    title="نام"
    value="{{ $model->name }}" 
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="link" 
    title="پیوند"
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

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="depth" 
    title="عمق"
    value="{{ $model->depth }}" 
></i-text>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="menu_type" 
    title="نوع"
    :options="{{ get_option_from_array($menu_types) }}" 
    :value="{{ get_selected_option_from_array($menu_types, $model->menu_type) }}"
></i-multiselect>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="image" 
    title="تصویر"
    action="{{ $model->store_uri }}" 
    value="{{ $model->image }}"
></i-uploader>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="removable" 
    title="قابل حذف"
    :value="{{ $model->removable }}" 
></i-checkbox>