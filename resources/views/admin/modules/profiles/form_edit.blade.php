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
    name="email" 
    title="ایمیل"
    value="{{ $model->email }}" 
></i-text>

<i-text 
    type="password" 
    :form="form" 
    :form_data="form_data" 
    name="password" 
    title="گذرواژه"
></i-text>

<i-text 
    type="password" 
    :form="form" 
    :form_data="form_data" 
    name="password_confirmation" 
    title="تکرار گذرواژه"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="mobile" 
    title="تلفن همراه"
    value="{{ $model->mobile }}" 
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="phone" 
    title="تلفن ثابت"
    value="{{ $model->phone }}" 
></i-text>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="address" 
    title="آدرس"
    value="{{ $model->address }}" 
></i-textarea>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="avatar" 
    title="تصویر پروفایل"
    value="{{ $model->avatar }}"
    action="/admins/admins" 
></i-uploader>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="numbers" 
    title="شماره های دریافت پیامک"
    value="{{ $model->numbers }}" 
    help="هر شماره در یک خط، شروع شماره با 98+"
></i-textarea>
