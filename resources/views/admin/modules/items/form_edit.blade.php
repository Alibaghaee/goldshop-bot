<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="locale" 
    title="@lang('Locale')"
    :options="{{ languages() }}"
    :value="{{ json_encode(languages()->where('key', app()->getLocale())->first()) }}"
></i-multiselect>

<i-text-locale 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="@lang('Title')" 
    :values="{{ json_encode($model->getTranslations('title')) }}" 
    :active_locale="form_data['locale']"
></i-text-locale>

<i-textarea-locale 
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="@lang('Department')"
    value="{{ $model->description }}" 
    :values="{{ json_encode($model->getTranslations('description')) }}" 
    :active_locale="form_data['locale']"
></i-textarea-locale>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="type" 
    title="@lang('Type')"
    :options="{{ $types }}" 
    :value="{{ get_selected_option_from_array($types->toArray(), $model->type) }}"
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="service_priority_id" 
    title="Priority"
    :options="{{ $service_priorities }}" 
    :value="{{ get_selected_option_from_array($service_priorities->toArray(), $model->service_priority_id) }}"
></i-multiselect>

{{-- <i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="price" 
    title="Price"
    value="{{ $model->price }}"
></i-text> --}}

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="active" 
    title="Active"
    :value="{{ $model->active }}"
></i-checkbox>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="icon" 
    title="Icon"
    action="{{ $model->store_uri }}" 
    value="{{ $model->icon }}"
></i-uploader>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="watch_icon" 
    title="@lang('Native App Icon')"
    action="{{ $model->store_uri }}" 
    value="{{ $model->watch_icon }}"
></i-uploader>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="options" 
    title="@lang('Options')"
    :options="{{ $options }}" 
    :value="{{ $model->options()->asOption() }}"
    :multiple="true"
    :close_on_select="false"
    :searchable="false"
></i-multiselect>