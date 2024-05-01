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
    type="text"
    :form="form"
    :form_data="form_data"
    name="domain"
    title="@lang('Domain')"
    value="{{ $model->domain }}"
></i-text>

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
    name="languages"
    title="@lang('Languages')"
    :options="{{ $languages }}"
    :multiple="true"
    :close_on_select="false"
    :searchable="true"
    :value="{{ $model->languages()->withoutGlobalScopes()->asOption() }}"
></i-multiselect>

<i-checkbox
    :form="form"
    :form_data="form_data"
    name="active"
    title="@lang('Active')"
    :value="{{ $model->active }}"
></i-checkbox>

<i-checkbox
        :form="form"
        :form_data="form_data"
        name="custom_sort"
        title="@lang('Custom sort')"
        :value="{{ $model->custom_sort }}"
></i-checkbox>

<i-checkbox
        :form="form"
        :form_data="form_data"
        name="bed_has_main_menu"
        title="@lang('Bed has main menu')"
        :value="{{ $model->bed_has_main_menu }}"
></i-checkbox>


<i-checkbox
        :form="form"
        :form_data="form_data"
        name="bed_has_link_menu"
        title="@lang('Bed has link menu')"
        :value="{{ $model->bed_has_link_menu }}"
></i-checkbox>

<div v-if="form_data.bed_has_link_menu">
    <i-text
            type="number"
            :form="form"
            :form_data="form_data"
            name="bed_limit_link_menu"
            title="@lang('Bed limit link menu')"
            value="{{$model->bed_limit_link_menu}}"
    ></i-text>
</div>


<i-date
    :form="form"
    :form_data="form_data"
    name="expire_date"
    title="@lang('Expire Date')"
    value="{{ $model->expire_date }}"
></i-date>

<i-uploader
    :form="form"
    :form_data="form_data"
    name="logo"
    title="@lang('Logo')"
    action="{{ $model->store_uri }}"
    value="{{ $model->logo }}"
></i-uploader>
