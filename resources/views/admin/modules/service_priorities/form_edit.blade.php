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

<i-text 
    type="number" 
    :form="form" 
    :form_data="form_data" 
    name="code" 
    title="@lang('Code')"
    help="The lower, the higher priority"
    value="{{ $model->code }}"
></i-text>

<i-textarea-locale 
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="@lang('Description')"
    value="{{ $model->description }}" 
    :values="{{ json_encode($model->getTranslations('description')) }}" 
    :active_locale="form_data['locale']"
></i-textarea-locale>

<i-text 
    type="number" 
    :form="form" 
    :form_data="form_data" 
    name="response_time" 
    title="@lang('Response Time')"
    help="In minutes"
    value="{{ $model->response_time }}"
></i-text>