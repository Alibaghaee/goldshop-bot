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

<i-color-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="color" 
    title="@lang('Color')"
    :options="{{ get_option_from_array($colors) }}" 
></i-color-multiselect>


<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="@lang('Department')"
></i-textarea>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="global" 
    title="Global"
></i-checkbox>
