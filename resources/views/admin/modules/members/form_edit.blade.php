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
    name="family" 
    title="نام خانوادگی"
    value="{{ $model->family }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="mobile" 
    title="موبایل"
    value="{{ $model->mobile }}"
></i-text>

<i-province 
    :form="form" 
    :form_data="form_data" 
    :province_value="{{ get_selected_option_from_array($provinces->toArray(), $model->province_id) }}"
    :city_value="{{ get_selected_option_from_array($cities->toArray(), $model->city_id) }}" 
></i-province>

<i-date 
    :form="form" 
    :form_data="form_data" 
    name="birth_date" 
    title="تاریخ تولد"
    format="YYYY-MM-DD"
    display_format="jYYYY/jMM/jDD"
    value="{{ $model->birth_date }}"
></i-date>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="complete" 
    title="تکمیل"
    :value="{{ $model->complete }}"
></i-checkbox>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="blacklist" 
    title="حذف شده"
    :value="{{ $model->blacklist }}"
></i-checkbox>