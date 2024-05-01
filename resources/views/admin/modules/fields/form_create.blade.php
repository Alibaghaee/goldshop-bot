<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="label" 
    title="عنوان"
></i-text>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="type" 
    title="نوع"
    :options="{{ json_encode($types) }}" 
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="name" 
    title="نام ستون"
    :options="{{ json_encode($form_fields_name) }}" 
></i-multiselect>


<i-multiselect 
    v-if="form_data.type && form_data.type.id == 3"
    :form="form" 
    :form_data="form_data" 
    name="category_id" 
    title="گروه انتخابی"
    :options="{{ $categories }}" 
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="rules" 
    title="اعتبار سنجی ها"
    :options="{{ $rules }}" 
    :multiple="true"
    :close_on_select="false"
    :searchable="false"
></i-multiselect>
