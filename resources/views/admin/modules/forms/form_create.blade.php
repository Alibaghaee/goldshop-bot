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
    name="fields" 
    title="فیلدها"
    :options="{{ $fields }}" 
    :multiple="true"
    :close_on_select="false"
    :searchable="false"
></i-multiselect>
