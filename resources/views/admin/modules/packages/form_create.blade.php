<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="عنوان"
></i-text>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="form_id" 
    title="فرم"
    :options="{{ get_option_from_array($forms) }}" 
></i-multiselect>

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="info" 
    title="اطلاعات پکیج"
></i-textarea>

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="national_code_description" 
    title="توضیحات صفحه کد ملی"
></i-textarea>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="products" 
    title="محتوای آموزشی"
    :options="{{ get_option_from_array($products) }}" 
    :multiple="true"
    :close_on_select="false"
    :searchable="false"
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="category_id" 
    title="گروه اصلی"
    :options="{{ get_option_from_array($categories) }}" 
></i-multiselect>

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="first_description" 
    title="توضیحات بخش اول ثبت نام"
></i-textarea>

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="second_description" 
    title="توضیحات بخش دوم ثبت نام"
></i-textarea>

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="agreement_text" 
    title="تعهد نامه و خدمات"
></i-textarea>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="price" 
    title="مبلغ کل"
></i-text>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="allow_installment" 
    title="پیش پرداخت"
></i-checkbox>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="pre_payment" 
    title="مبلغ پیش پرداخت"
></i-text>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="image" 
    title="تصویر"
    action="{{ $model->store_uri }}" 
></i-uploader>

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="full_payment_message" 
    title="متن رسید پرداخت (پرداخت کامل)"
></i-textarea>

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="pre_payment_message" 
    title="متن رسید پرداخت (پیش پرداخت)"
></i-textarea>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="active" 
    title="فعال"
></i-checkbox>