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

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="tabiat_product_category_id" 
    title="گروه"
    :options="{{ get_option_from_array($tabiat_product_categories) }}" 
    :value="{{ get_selected_option_from_array($tabiat_product_categories->toArray(), $model->tabiat_product_category_id) }}" 
></i-multiselect>
