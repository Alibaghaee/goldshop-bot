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

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="phone" 
    title="تلفن"
></i-text>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="address" 
    title="آدرس"
></i-textarea>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="visit_duration" 
    title="زمان هر نوبت (min)"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="visit_fee" 
    title="هزینه ویزیت (تومان)"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="expert_contribution" 
    title="سهم متخصص (%)"
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
    name="department_id" 
    title="بخش"
    :options="{{ $departments }}" 
></i-multiselect>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="image" 
    title="تصویر"
    action="{{ $model->store_uri }}" 
></i-uploader>
