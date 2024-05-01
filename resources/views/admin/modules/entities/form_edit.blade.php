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
    name="room_id"
    title="@lang('Room')"
    :options="{{ $rooms }}"
    :value="{{ get_selected_option_from_array($rooms->toArray(), $model->room_id) }}"
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

{{-- <i-checkbox
    :form="form"
    :form_data="form_data"
    name="payable"
    title="@lang('Payable')"
    :value="{{ $model->payable }}"
></i-checkbox> --}}

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="gender"
    title="@lang('Gender')"
    :options="{{ get_option_from_array(config('portal.gender_options')) }}"
    :value="{{ get_selected_option_from_array(config('portal.gender_options'), $model->gender) }}"
></i-multiselect>

{{-- <i-multiselect
    :form="form"
    :form_data="form_data"
    name="auth_type"
    title="@lang('Auth Type')"
    :options="{{ get_option_from_array(config('portal.auth_types')) }}"
    :value="{{ get_selected_option_from_array(config('portal.auth_types'), $model->auth_type) }}"
></i-multiselect> --}}

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="service_category"
    title="@lang('Service Category')"
    :options="{{ $service_categories }}"
></i-multiselect>

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="entity_items"
    title="@lang('Services')"
    :options="{{ $items }}"
    :multiple="true"
    :close_on_select="false"
    :searchable="true"
    :value="form_data.service_category ? form_data.service_category.services : {{ $model->items()->asOption() }}"
></i-multiselect>

<i-checkbox
    :form="form"
    :form_data="form_data"
    name="active"
    title="@lang('Active')"
    :value="{{ $model->active }}"
></i-checkbox>


<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="location_id"
    title="@lang('Location ID')"
    value="{{ $model->location_id }}"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="location_city"
    title="@lang('Location City')"
    value="{{ $model->location_city }}"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="location_building"
    title="@lang('Location Building')"
    value="{{ $model->location_building }}"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="location_department"
    title="@lang('Location Department')"
    value="{{ $model->location_department }}"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="location_room"
    title="@lang('Location Room')"
    value="{{ $model->location_room }}"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="location_bed"
    title="@lang('Location Bed')"
    value="{{ $model->location_bed }}"
></i-text>


<i-textarea-locale
        :form="form"
        :form_data="form_data"
        name="plato_destination"
        title="Plato destination"
        value="{{ $model->plato_destination }}"
></i-textarea-locale>