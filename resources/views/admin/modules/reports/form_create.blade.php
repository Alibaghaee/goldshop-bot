<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="عنوان"
></i-text>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="chart_type" 
    title="نوع نمودار"
    :options="{{ get_option_from_array($chart_types) }}" 
></i-multiselect>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="note" 
    title="متن"
></i-textarea>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="sms_status" 
    title="وضعیت پیامک دریافتی"
    :options="{{ get_option_from_array($sms_status) }}" 
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="sms_code_state" 
    title="وضعیت کد دریافتی"
    :options="{{ get_option_from_array($sms_code_state) }}" 
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="product_category_id" 
    title="گروه محصول"
    :options="{{ get_option_from_array($product_categories) }}" 
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="product_id" 
    title="محصول"
    :options="{{ get_option_from_array($products) }}" 
></i-multiselect>

<i-date 
    :form="form" 
    :form_data="form_data" 
    name="date_from" 
    title="از تاریخ"
></i-date>

<i-date 
    :form="form" 
    :form_data="form_data" 
    name="date_to" 
    title="تا تاریخ"
></i-date>
