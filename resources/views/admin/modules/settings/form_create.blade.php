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
    name="type" 
    title="نوع"
    :options="{{ get_option_from_array($types) }}" 
></i-multiselect>

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="value" 
    title="مقدار"
    {{-- v-if="form_data.hasOwnProperty('type') && form_data.type.id == 0" --}}
></i-textarea>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="value" 
    title="فایل"
    action="/settings/settings" 
    {{-- v-if="form_data.hasOwnProperty('type') && form_data.type.id == 1" --}}
></i-uploader>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="removable" 
    title="قابل حذف"
></i-checkbox>


