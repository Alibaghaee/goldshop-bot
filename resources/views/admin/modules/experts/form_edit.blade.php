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

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="phone" 
    title="تلفن"
    value="{{ $model->phone }}"
></i-text>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="address" 
    title="آدرس"
    value="{{ $model->address }}"
></i-textarea>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="visit_duration" 
    title="زمان هر نوبت (min)"
    value="{{ $model->visit_duration }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="visit_fee" 
    title="هزینه ویزیت (تومان)"
    value="{{ $model->visit_fee }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="expert_contribution" 
    title="سهم متخصص (%)"
    value="{{ $model->expert_contribution }}"
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
    name="department_id" 
    title="بخش"
    :options="{{ $departments }}" 
    :value="{{ $model->department->asOption()->first() }}" 
></i-multiselect>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="image" 
    title="تصویر"
    action="{{ $model->store_uri }}" 
    value="{{ $model->image }}"
    method="put"
></i-uploader>
