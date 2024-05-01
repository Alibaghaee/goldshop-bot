<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="type" 
    title="نوع"
    :options="{{ json_encode($customer_types) }}" 
    :value="{{ get_selected_option_from_array($customer_types, $model->type) }}"
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="group_id" 
    title="گروه"
    :options="{{ $customer_groups }}" 
    :value="{{ get_selected_option_from_array($category_items->toArray(), $model->group_id) }}"
></i-multiselect>

<div class="mb-6 mb-6 text-grey-dark border-r-4 border-grey-dark pr-4 font-bold">اطلاعات عمومی:</div>

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
    name="postal_code" 
    title="کد پستی"
    value="{{ $model->postal_code }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="email" 
    title="ایمیل"
    value="{{ $model->email }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="phone" 
    title="تلفن"
    value="{{ $model->phone }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="fax" 
    title="فکس"
    value="{{ $model->fax }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="website" 
    title="سایت"
    value="{{ $model->website }}"
></i-text>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="how_know_id" 
    title="نحوه آشنایی"
    :options="{{ $how_know_types }}" 
    :value="{{ get_selected_option_from_array($category_items->toArray(), $model->how_know_id) }}"
></i-multiselect>

<div class="mb-6 mb-6 text-grey-dark border-r-4 border-grey-dark pr-4 font-bold">شخص حقوقی:</div>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="company_name" 
    title="نام شرکت"
    value="{{ $model->company_name }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="economic_code" 
    title="کد اقتصادی"
    value="{{ $model->economic_code }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="company_national_code" 
    title="شناسه ملی شرکت"
    value="{{ $model->company_national_code }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="register_id" 
    title="شناسه ثبت"
    value="{{ $model->register_id }}"
></i-text>

<div class="mb-6 mb-6 text-grey-dark border-r-4 border-grey-dark pr-4 font-bold">شخص حقیقی / نماینده حقوقی:</div>

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
    name="father_name" 
    title="نام پدر"
    value="{{ $model->father_name }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="national_code" 
    title="کد ملی"
    value="{{ $model->national_code }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="id_number" 
    title="شماره شناسنامه"
    value="{{ $model->id_number }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="place" 
    title="محل تولد"
    value="{{ $model->place }}"
></i-text>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="sex" 
    title="جنسیت"
    :options="{{ json_encode($sex) }}" 
    :value="{{ get_selected_option_from_array($sex, $model->sex) }}"
></i-multiselect>

<i-date 
    :form="form" 
    :form_data="form_data" 
    name="birth_date" 
    title="تاریخ تولد"
    format="YYYY-MM-DD"
    display_format="jYYYY/jMM/jDD"
    value="{{ $model->birth_date }}"
></i-date>