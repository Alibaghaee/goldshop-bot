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

<i-text 
    type="number" 
    :form="form" 
    :form_data="form_data" 
    name="code" 
    title="@lang('Code')"
    help="The lower, the higher priority"
></i-text>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="@lang('Description')"
></i-textarea>

<i-text 
    type="number" 
    :form="form" 
    :form_data="form_data" 
    name="response_time" 
    title="@lang('Response Time')"
    help="In minutes"
></i-text>