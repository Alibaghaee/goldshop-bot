<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="عنوان"
    value="{{ $model->title }}"
></i-text>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="form_id" 
    title="فرم"
    :options="{{ get_option_from_array($forms) }}" 
    :value="{{ get_selected_option_from_array($forms->toArray(), $model->form_id) }}" 
></i-multiselect>

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="info" 
    title="اطلاعات پکیج"
    value="{{ $model->info }}"
></i-textarea>

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="national_code_description" 
    title="توضیحات صفحه کد ملی"
    value="{{ $model->national_code_description }}"
></i-textarea>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="products"
    title="محتوای آموزشی"
    :options="{{ get_option_from_array($products) }}" 
    :value="{{ $model->products()->asOption() }}"
    :multiple="true"
    :close_on_select="false"
    :searchable="false"
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="category_id" 
    title="گروه اصلی"
    :options="{{ $categories }}" 
    :value="{{ get_selected_option_from_array($categories->toArray(), $model->category_id) }}" 
></i-multiselect>

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="first_description" 
    title="توضیحات بخش اول ثبت نام"
    value="{{ $model->first_description }}"
></i-textarea>

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="second_description" 
    title="توضیحات بخش دوم ثبت نام"
    value="{{ $model->second_description }}"
></i-textarea>

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="agreement_text" 
    title="تعهد نامه و خدمات"
    value="{{ $model->agreement_text }}"
></i-textarea>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="price" 
    title="مبلغ کل"
    value="{{ $model->price }}"
></i-text>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="allow_installment" 
    title="پیش پرداخت"
    :value="{{ $model->allow_installment }}"
></i-checkbox>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="pre_payment" 
    title="مبلغ پیش پرداخت"
    value="{{ $model->pre_payment }}"
></i-text>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="image" 
    title="تصویر"
    action="{{ $model->store_uri }}" 
    value="{{ $model->image }}"
></i-uploader>

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="full_payment_message" 
    title="متن رسید پرداخت (پرداخت کامل)"
    value="{{ $model->full_payment_message }}"
></i-textarea>

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="pre_payment_message" 
    title="متن رسید پرداخت (پیش پرداخت)"
    value="{{ $model->pre_payment_message }}"
></i-textarea>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="active" 
    title="فعال"
    value="{{ $model->active }}"
></i-checkbox>