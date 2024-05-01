<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="عنوان"
    value="{{ $model->title }}" 
></i-text>

{{-- <i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="type" 
    title="نوع"
    :options="{{ get_option_from_array($types) }}" 
    :value="{{ get_selected_option_from_array($types, $model->type) }}"
></i-multiselect> --}}

{{-- @if($model->type == 1) --}}
<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="value" 
    title="مقدار"
    value="{{ $model->value }}" 
    {{-- v-if="form_data.hasOwnProperty('type') && form_data.type.id == 1" --}}
></i-textarea>
{{-- @endif --}}

{{-- @if($model->type == 2) --}}
<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="value" 
    title="فایل"
    action="/settings/settings" 
    value="{{ $model->value }}"
    {{-- v-if="form_data.hasOwnProperty('type') && form_data.type.id == 2" --}}
></i-uploader>
{{-- @endif --}}

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="removable" 
    title="قابل حذف"
    :value="{{ $model->removable }}" 
></i-checkbox>


