<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="customer_fullname" 
    title="نام مشتری"
    value="{{ $model->customer_fullname }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="customer_code" 
    title="کد مشتری"
    value="{{ $model->customer_code }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="customer_phone" 
    title="تلفن"
    value="{{ $model->customer_phone }}"
></i-text>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="shop_has_sign" 
    title="تابلو سر درب"
    :options="{{ get_option_from_array($shop_has_sign) }}" 
    :value="{{ get_selected_option_from_array($shop_has_sign, $model->shop_has_sign) }}"
></i-multiselect>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="shop_address" 
    title="آدرس"
    value="{{ $model->shop_address }}"
></i-textarea>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="shop_grade" 
    title="گرید فروشگاه"
    :options="{{ get_option_from_array($shop_grades) }}" 
    :value="{{ get_selected_option_from_array($shop_grades, $model->shop_grade) }}"
></i-multiselect>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="shop_salesman" 
    title="فروشنده"
    value="{{ $model->shop_salesman }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="shop_manager" 
    title="سرپرست"
    value="{{ $model->shop_manager }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="shop_region" 
    title="منطقه"
    value="{{ $model->shop_region }}"
></i-text>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="shop_pakhor" 
    title="پاخور فروشگاه"
    :options="{{ get_option_from_array($shop_pakhors) }}" 
    :value="{{ get_selected_option_from_array($shop_pakhors, $model->shop_pakhor) }}"
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="shop_ownership_status" 
    title="نوع واحد تجاری"
    :options="{{ get_option_from_array($shop_ownership_status) }}" 
    :value="{{ get_selected_option_from_array($shop_ownership_status, $model->shop_ownership_status) }}"
></i-multiselect>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="shop_size" 
    title="متراژ"
    value="{{ $model->shop_size }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="shop_shelf_size" 
    title="متراژ قفسه مغازه"
    value="{{ $model->shop_shelf_size }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="shop_shelf_aarrangement_space_size" 
    title="متراژ فضای چیدمان"
    value="{{ $model->shop_shelf_aarrangement_space_size }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="shop_mesh_and_sticker_installation_space" 
    title="فضای نصب مش و استیکر"
    value="{{ $model->shop_mesh_and_sticker_installation_space }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="shop_line_count" 
    title="تعداد لاین"
    value="{{ $model->shop_line_count }}"
></i-text>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="shop_available_products" 
    title="محصولات موجود"
    :options="{{ $shop_available_products }}" 
    :value="{{ $shop_available_active_products }}"
    group_label="name"
    group_values="items"
    :multiple="true"
    :close_on_select="false"
    :searchable="false"
></i-multiselect>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="image" 
    title="تصویر"
    value="{{ $model->image }}"
    action="{{ $model->store_uri }}" 
></i-uploader>

{{-- <i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="shop_purchase_status_1400" 
    title="وضعیت خرید سال 1400"
    value="{{ Illuminate\Support\Arr::get($model->shop_purchase_status, 'shop_purchase_status_1400') }}"
    ></i-text>
    
    <i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="shop_purchase_status_1401" 
    title="وضعیت خرید سال 1401"
    value="{{ Illuminate\Support\Arr::get($model->shop_purchase_status, 'shop_purchase_status_1401') }}"
></i-text> --}}

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="cooperation_status" 
    title="سابقه همکاری"
    :options="{{ get_option_from_array($cooperation_status) }}" 
    :value="{{ get_selected_option_from_array($cooperation_status, $model->cooperation_status) }}"
></i-multiselect>

{{-- <i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="sales_supervisor_comment" 
    title="اظهارات سرپرست فروش"
    value="{{ $model->sales_supervisor_comment }}"
></i-textarea>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="region_supervisor_comment" 
    title="اظهارات سورپروایز منطقه"
    value="{{ $model->region_supervisor_comment }}"
></i-textarea>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="sales_manager_comment" 
    title="اظهارات مدیر فروش"
    value="{{ $model->sales_manager_comment }}"
></i-textarea> --}}

{{-- <i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="status" 
    title="وضعیت"
    :options="{{ get_option_from_array($status) }}" 
    :value="{{ get_selected_option_from_array($status, $model->status) }}"
></i-multiselect> --}}