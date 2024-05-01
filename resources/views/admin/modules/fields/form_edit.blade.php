<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="label" 
    title="عنوان"
    value="{{ $model->label }}"
></i-text>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="type" 
    title="نوع"
    :options="{{ json_encode($types) }}" 
    :value="{{ get_selected_option_from_array($types, $model->type) }}"
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="name" 
    title="نام ستون"
    :options="{{ json_encode($form_fields_name) }}" 
    :value="{{ get_selected_option_from_array($form_fields_name, $model->name, 'name') }}"
></i-multiselect>

<i-multiselect 
    v-if="form_data.type && form_data.type.id == 3"
    :form="form" 
    :form_data="form_data" 
    name="category_id" 
    title="گروه انتخابی"
    :options="{{ $categories }}" 
    :value="{{ get_selected_option_from_array($categories->toArray(), $model->category_id) }}"
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="rules"
    title="اعتبار سنجی ها"
    :options="{{ $rules }}" 
    :value="{{ $model->rules()->asOption() }}"
    :multiple="true"
    :close_on_select="false"
    :searchable="false"
></i-multiselect>
