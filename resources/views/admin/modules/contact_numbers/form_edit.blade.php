<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="name"
    title="نام"
    value="{{  $model->name }}"

></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="en_name"
    title="نام لاتین"
    value="{{  $model->en_name }}"

></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="mobile"
    title="موبایل"
    value="{{  $model->mobile }}"
></i-text>


<i-multiselect
    :form="form"
    :form_data="form_data"
    name="status"
    title="وضعیت"
    :options="{{json_encode($status)}}"
    :value="{{ get_selected_option_from_array($status,$model->status) }}"
></i-multiselect>

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="gender"
    title="جنسیت"
    :options="{{json_encode($gender)}}"
    :value="{{ get_selected_option_from_array($gender,$model->gender) }}"
></i-multiselect>

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="contact_category_id"
    title="گروه مخاطبین"
    :options="{{json_encode($contactCategories)  }}"
    :value="{{ get_selected_option_from_array($contactCategories->toArray(),$model->contact_category_id) }}"
></i-multiselect>


