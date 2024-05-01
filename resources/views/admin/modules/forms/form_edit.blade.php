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
    name="fields"
    title="فیلدها"
    :options="{{ $fields }}" 
    :value="{{ $model->fields()->asOption() }}"
    :multiple="true"
    :close_on_select="false"
    :searchable="false"
></i-multiselect>
