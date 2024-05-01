<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="customer_fullname" 
    title="نام مشتری"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="customer_code" 
    title="کد مشتری"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="customer_phone" 
    title="تلفن"
></i-text>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="shop_has_sign" 
    title="تابلو سر درب"
    :options="{{ get_option_from_array($shop_has_sign) }}" 
></i-multiselect>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="shop_address" 
    title="آدرس"
></i-textarea>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="shop_grade" 
    title="گرید فروشگاه"
    :options="{{ get_option_from_array($shop_grades) }}" 
></i-multiselect>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="shop_salesman" 
    title="فروشنده"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="shop_manager" 
    title="سرپرست"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="shop_region" 
    title="منطقه"
></i-text>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="shop_pakhor" 
    title="پاخور فروشگاه"
    :options="{{ get_option_from_array($shop_pakhors) }}" 
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="shop_ownership_status" 
    title="نوع واحد تجاری"
    :options="{{ get_option_from_array($shop_ownership_status) }}" 
></i-multiselect>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="shop_size" 
    title="متراژ"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="shop_shelf_size" 
    title="متراژ قفسه مغازه"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="shop_shelf_aarrangement_space_size" 
    title="متراژ فضای چیدمان"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="shop_mesh_and_sticker_installation_space" 
    title="فضای نصب مش و استیکر"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="shop_line_count" 
    title="تعداد لاین"
></i-text>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="shop_available_products" 
    title="محصولات موجود"
    :options="{{ $shop_available_products }}" 
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
    action="{{ $model->store_uri }}" 
></i-uploader>

{{-- <i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="shop_purchase_status_1400" 
    title="وضعیت خرید سال 1400"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="shop_purchase_status_1401" 
    title="وضعیت خرید سال 1401"
></i-text> --}}

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="cooperation_status" 
    title="سابقه همکاری"
    :options="{{ get_option_from_array($cooperation_status) }}" 
></i-multiselect>

{{-- <i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="sales_supervisor_comment" 
    title="اظهارات سرپرست فروش"
></i-textarea> --}}

{{-- <i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="region_supervisor_comment" 
    title="اظهارات سورپروایز منطقه"
></i-textarea> --}}

{{-- <i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="sales_manager_comment" 
    title="اظهارات مدیر فروش"
></i-textarea> --}}

{{-- <i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="status" 
    title="وضعیت"
    :options="{{ get_option_from_array($status) }}" 
></i-multiselect> --}}
