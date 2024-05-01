<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="type" 
    title="نوع"
    :options="{{ json_encode($customer_types) }}" 
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="group_id" 
    title="گروه"
    :options="{{ $customer_groups }}"
></i-multiselect>

<div class="mb-6 mb-6 text-grey-dark border-r-4 border-grey-dark pr-4 font-bold">اطلاعات عمومی:</div>

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
    name="postal_code" 
    title="کد پستی"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="email" 
    title="ایمیل"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="phone" 
    title="تلفن"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="fax" 
    title="فکس"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="website" 
    title="سایت"
></i-text>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="how_know" 
    title="نحوه آشنایی"
    :options="{{ $how_know_types }}"
></i-multiselect>

<div class="mb-6 mb-6 text-grey-dark border-r-4 border-grey-dark pr-4 font-bold">شخص حقوقی:</div>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="company_name" 
    title="نام شرکت"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="economic_code" 
    title="کد اقتصادی"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="company_national_code" 
    title="شناسه ملی شرکت"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="register_id" 
    title="شناسه ثبت"
></i-text>

<div class="mb-6 mb-6 text-grey-dark border-r-4 border-grey-dark pr-4 font-bold">شخص حقیقی / نماینده حقوقی:</div>

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
    name="father_name" 
    title="نام پدر"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="national_code" 
    title="کد ملی"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="id_number" 
    title="شماره شناسنامه"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="place" 
    title="محل تولد"
></i-text>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="sex" 
    title="جنسیت"
    :options="{{ json_encode($sex) }}" 
></i-multiselect>

<i-date 
    :form="form" 
    :form_data="form_data" 
    name="birth_date" 
    title="تاریخ تولد"
    format="YYYY-MM-DD"
    display_format="jYYYY/jMM/jDD"
></i-date>