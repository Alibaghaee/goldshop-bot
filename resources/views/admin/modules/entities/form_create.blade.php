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

{{-- <i-checkbox
    :form="form"
    :form_data="form_data"
    name="payable"
    title="@lang('Payable')"
></i-checkbox> --}}

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="gender"
    title="@lang('Gender')"
    :options="{{ get_option_from_array(config('portal.gender_options')) }}"
></i-multiselect>

{{-- <i-multiselect
    :form="form"
    :form_data="form_data"
    name="auth_type"
    title="@lang('Auth Type')"
    :options="{{ get_option_from_array(config('portal.auth_types')) }}"
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
    :value="form_data.service_category ? form_data.service_category.services : null"
></i-multiselect>

<i-checkbox
    :form="form"
    :form_data="form_data"
    name="active"
    title="@lang('Active')"
    :value="true"
></i-checkbox>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="location_id"
    title="@lang('Location ID')"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="location_city"
    title="@lang('Location City')"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="location_building"
    title="@lang('Location Building')"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="location_department"
    title="@lang('Location Department')"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="location_room"
    title="@lang('Location Room')"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="location_bed"
    title="@lang('Location Bed')"
></i-text>


<i-textarea
        :form="form"
        :form_data="form_data"
        name="plato_destination"
        title="Plato destination"
></i-textarea>
