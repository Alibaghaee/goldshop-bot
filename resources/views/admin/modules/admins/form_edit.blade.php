<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="level_id" 
    title="سطح دسترسی"
    :options="{{ $levels }}" 
    :value="{{ $levels->where('id', $model->level_id)->first() }}" 
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="role_id" 
    title="نقش کاربری"
    :options="{{ $roles }}" 
    :value="{{ $roles->where('id', $model->role_id)->first() }}" 
></i-multiselect>

{{-- <i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="category_item_id" 
    title="گروه"
    :options="{{ $categories }}" 
    group_label="name"
    group_values="items"
    :value="{{ get_selected_option_from_array($category_items->toArray(), $model->category_item_id) }}"
></i-multiselect> --}}

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
    name="username" 
    title="نام کاربری"
    value="{{ $model->username }}" 
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

<i-time 
    :form="form" 
    :form_data="form_data" 
    name="enter_time" 
    title="ساعت شروع کار"
    value="{{ $model->enter_time }}" 
></i-time>

<i-time 
    :form="form" 
    :form_data="form_data" 
    name="exit_time" 
    title="ساعت پایان کار"
    value="{{ $model->exit_time }}" 
></i-time>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="avatar" 
    title="تصویر پروفایل"
    value="{{ $model->avatar }}"
    action="/admins/admins" 
></i-uploader>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="document" 
    title="مدارک"
    value="{{ $model->document }}"
    action="/admins/admins" 
></i-uploader>