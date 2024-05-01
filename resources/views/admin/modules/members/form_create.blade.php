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
    name="family" 
    title="نام خانوادگی"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="mobile" 
    title="موبایل"
></i-text>

<i-province 
    :form="form" 
    :form_data="form_data"
></i-province>

<i-date 
    :form="form" 
    :form_data="form_data" 
    name="birth_date" 
    title="تاریخ تولد"
    format="YYYY-MM-DD"
    display_format="jYYYY/jMM/jDD"
></i-date>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="complete" 
    title="تکمیل"
></i-checkbox>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="blacklist" 
    title="حذف شده"
></i-checkbox>