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

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="tabiat_product_category_id" 
    title="گروه"
    :options="{{ get_option_from_array($tabiat_product_categories) }}" 
></i-multiselect>
