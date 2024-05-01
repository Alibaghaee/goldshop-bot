<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="tabiat_product_id" 
    title="محصول"
    :options="{{ get_option_from_array($tabiat_products) }}" 
></i-multiselect>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="count" 
    title="تعداد"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="length" 
    title="تعداد ارقام کد"
></i-text>


