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
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="domain" 
    title="@lang('Domain')"
></i-text>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="@lang('Department')"
></i-textarea>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="languages" 
    title="@lang('Languages')"
    :options="{{ $languages }}" 
    :multiple="true"
    :close_on_select="false"
    :searchable="true"
></i-multiselect>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="active" 
    title="@lang('Active')"
></i-checkbox>

<i-checkbox
    :form="form"
    :form_data="form_data"
    name="custom_sort"
    title="@lang('Custom sort')"
></i-checkbox>


<i-checkbox
    :form="form"
    :form_data="form_data"
    name="bed_has_main_menu"
    title="@lang('Bed has main menu')"
></i-checkbox>


<i-checkbox
    :form="form"
    :form_data="form_data"
    name="bed_has_link_menu"
    title="@lang('Bed has link menu')"
></i-checkbox>

<div v-if="form_data.bed_has_link_menu">
    <i-text
            type="number"
            :form="form"
            :form_data="form_data"
            name="bed_limit_link_menu"
            title="@lang('Bed limit link menu')"
            value="1"
    ></i-text>
</div>

<i-date 
    :form="form" 
    :form_data="form_data" 
    name="expire_date" 
    title="@lang('Expire Date')"
></i-date>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="logo" 
    title="@lang('Logo')"
    action="{{ $model->store_uri }}" 
></i-uploader>