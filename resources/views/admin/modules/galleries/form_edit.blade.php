<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="category_item_id" 
    title="گروه *"
    :options="{{ $categories }}" 
    group_label="name"
    group_values="items"
    :value="{{ $category_items->where('id', $model->category_item_id)->first() }}"
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="locale_id" 
    title="زبان"
    :options="{{ get_option_from_array($locales) }}" 
    :value="{{ get_selected_option_from_array($locales, $model->locale_id) }}"
></i-multiselect>

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
