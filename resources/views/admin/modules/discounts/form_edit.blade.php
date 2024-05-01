<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="عنوان"
    value="{{ $model->title }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="discount_amount" 
    title="میزان تخفیف"
    value="{{ $model->discount_amount }}"
></i-text>

{{-- <i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="max_uses" 
    title="دفعات مجاز استفاده"
    value="{{ $model->max_uses }}"
></i-text>

<i-date 
    :form="form" 
    :form_data="form_data" 
    name="starts_at" 
    title="تاریخ شروع"
    value="{{ $model->starts_at }}"
></i-date>

<i-date 
    :form="form" 
    :form_data="form_data" 
    name="expires_at" 
    title="تاریخ انقضا"
    value="{{ $model->expires_at }}"
></i-date> --}}