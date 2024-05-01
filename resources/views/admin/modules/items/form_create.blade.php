<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="locale" 
    title="@lang('Locale')"
    :options="{{ languages() }}"
    :value="{{ json_encode(languages()->where('key', app()->getLocale())->first()) }}"
></i-multiselect>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="@lang('Title')"
></i-text>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="@lang('Description')"
></i-textarea>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="type" 
    title="@lang('Type')"
    :options="{{ $types }}" 
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="service_priority_id" 
    title="@lang('Priority')"
    :options="{{ $service_priorities }}" 
    :value="{{ get_selected_option_from_array($service_priorities->toArray(), 3) }}"
></i-multiselect>

{{-- <i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="price" 
    title="@lang('Price')"
></i-text> --}}

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="active" 
    title="@lang('Active')"
    :value="true"
></i-checkbox>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="icon" 
    title="@lang('Icon')"
    action="{{ $model->store_uri }}" 
></i-uploader>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="watch_icon" 
    title="@lang('Native App Icon')"
    action="{{ $model->store_uri }}" 
></i-uploader>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="options" 
    title="@lang('Options')"
    :options="{{ $options }}" 
    :multiple="true"
    :close_on_select="false"
    :searchable="false"
></i-multiselect>