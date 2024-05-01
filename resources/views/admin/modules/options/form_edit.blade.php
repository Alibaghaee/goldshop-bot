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

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="image" 
    title="@lang('Image')"
    action="{{ $model->store_uri }}" 
    value="{{ $model->image }}"
></i-uploader>

<i-textarea-locale 
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="@lang('Description')"
    value="{{ $model->description }}" 
    :values="{{ json_encode($model->getTranslations('description')) }}" 
    :active_locale="form_data['locale']"
></i-textarea-locale>