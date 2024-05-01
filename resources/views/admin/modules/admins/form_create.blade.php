<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="level_id" 
    title="سطح دسترسی"
    :options="{{ $levels }}" 
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="role_id" 
    title="نقش کاربری"
    :options="{{ $roles }}" 
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="category_item_id" 
    title="گروه"
    :options="{{ $categories }}" 
    group_label="name"
    group_values="items"
></i-multiselect>

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
    name="username" 
    title="نام کاربری"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="email" 
    title="ایمیل"
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
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="phone" 
    title="تلفن ثابت"
></i-text>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="address" 
    title="آدرس"
></i-textarea>

<i-time 
    :form="form" 
    :form_data="form_data" 
    name="enter_time" 
    title="ساعت شروع کار"
></i-time>

<i-time 
    :form="form" 
    :form_data="form_data" 
    name="exit_time" 
    title="ساعت پایان کار"
></i-time>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="avatar" 
    title="تصویر پروفایل"
    action="/admins/admins" 
></i-uploader>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="document" 
    title="مدارک"
    action="/admins/admins" 
></i-uploader>
