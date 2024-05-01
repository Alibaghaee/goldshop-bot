<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="عنوان"
    value="{{ $model->title }}"
></i-text>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="chart_type" 
    title="نوع نمودار"
    :options="{{ get_option_from_array($chart_types) }}" 
    :value="{{ get_selected_option_from_array($chart_types, $model->chart_type) }}"
></i-multiselect>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="note" 
    title="متن"
    value="{{ $model->note }}"
></i-textarea>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="sms_status" 
    title="وضعیت پیامک دریافتی"
    :options="{{ get_option_from_array($sms_status) }}" 
    :value="{{ get_selected_option_from_array($sms_status, $model->sms_status) }}"
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="sms_code_state" 
    title="وضعیت کد دریافتی"
    :options="{{ get_option_from_array($sms_code_state) }}" 
    :value="{{ get_selected_option_from_array($sms_code_state, $model->sms_code_state) }}"
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="product_category_id" 
    title="گروه محصول"
    :options="{{ get_option_from_array($product_categories) }}" 
    :value="{{ get_selected_option_from_array($product_categories->toArray(), $model->product_category_id) }}"
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="product_id" 
    title="محصول"
    :options="{{ get_option_from_array($products) }}" 
    :value="{{ get_selected_option_from_array($products->toArray(), $model->product_id) }}"
></i-multiselect>

<i-date 
    :form="form" 
    :form_data="form_data" 
    name="date_from" 
    title="از تاریخ"
    value="{{ $model->date_from }}"
></i-date>

<i-date 
    :form="form" 
    :form_data="form_data" 
    name="date_to" 
    title="تا تاریخ"
    value="{{ $model->date_to }}"
></i-date>
