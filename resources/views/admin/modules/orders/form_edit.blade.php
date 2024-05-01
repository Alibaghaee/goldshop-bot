<i-textarea 
    :advance_editor="false"
    :form="form" 
    :form_data="form_data" 
    name="request_info" 
    title="مشخصات و نشانی متقاضی"
    value="{{ $model->request_info }}"
></i-textarea>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="product_type" 
    title="نوع کالا"
    value="{{ $model->product_type }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="packing_type" 
    title="نوع بسته بندی"
    value="{{ $model->packing_type }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="weight" 
    title="وزن تقریبی کالا"
    value="{{ $model->weight }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="volume" 
    title="حجم تقریبی کالا"
    value="{{ $model->volume }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="origin" 
    title="مبدا"
    value="{{ $model->origin }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="destination" 
    title="مقصد"
    value="{{ $model->destination }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="preparation_time" 
    title="زمان تقریبی آمادگی کالا برای بارگیری"
    value="{{ $model->preparation_time }}"
></i-text>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="transportation_type" 
    title="نوع وسیله حمل"
    :value="{{ get_selected_option_from_array($transportation_type, $model->transportation_type) }}"
    :options="{{ get_option_from_array($transportation_type) }}" 
></i-multiselect>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="fullname" 
    title="نام مسئول پیگیری"
    value="{{ $model->fullname }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="mobile" 
    title="موبایل"
    value="{{ $model->mobile }}"
></i-text>
