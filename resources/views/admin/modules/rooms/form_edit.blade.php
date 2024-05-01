<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="locale" 
    title="@lang('Locale')"
    :options="{{ languages() }}"
    :value="{{ json_encode(languages()->where('key', app()->getLocale())->first()) }}"
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="department_id" 
    title="@lang('Department')"
    :options="{{ $departments }}"
    :value="{{ get_selected_option_from_array($departments->toArray(), $model->department_id) }}" 
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