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
    name="en_name"
    title="نام لاتین"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="mobile"
    title="موبایل"
></i-text>


<i-multiselect
    :form="form"
    :form_data="form_data"
    name="status"
    title="وضعیت"
    :options="{{json_encode($status)}}"
></i-multiselect>

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="gender"
    title="جنسیت"
    :options="{{json_encode($gender)}}"
></i-multiselect>

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="contact_category_id"
    title="گروه مخاطبین"
    :options="{{$contactCategories}}"
></i-multiselect>


