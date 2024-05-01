<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="عنوان"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="discount_amount" 
    title="میزان تخفیف"
></i-text>

{{-- <i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="is_percent" 
    title="به درصد باشد؟"
></i-checkbox> --}}

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="count" 
    title="تعداد کد"
></i-text>

{{-- <i-text 
    v-if="form_data.count == 1"
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="code" 
    title="کد"
></i-text> --}}

{{-- <i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="max_uses" 
    title="دفعات مجاز استفاده"
></i-text> --}}

{{-- <i-date 
    :form="form" 
    :form_data="form_data" 
    name="starts_at" 
    title="تاریخ شروع"
></i-date>

<i-date 
    :form="form" 
    :form_data="form_data" 
    name="expires_at" 
    title="تاریخ انقضا"
></i-date> --}}