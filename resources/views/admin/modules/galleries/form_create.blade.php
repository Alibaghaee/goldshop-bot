<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="category_item_id" 
    title="گروه *"
    :options="{{ $categories }}" 
    group_label="name"
    group_values="items"
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="locale_id" 
    title="زبان"
    :options="{{ get_option_from_array($locales) }}" 
></i-multiselect>


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
    title="توضیحات"
></i-textarea>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="active" 
    title="وضعیت نمایش"
></i-checkbox>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="image" 
    title="تصویر"
    action="{{ $model->store_uri }}" 
></i-uploader>
