<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="entity_id"
    title="@lang('Bed')"
    :options="{{ $entities }}" 
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="entity_items" 
    title="@lang('Services')"
    :options="{{ $items }}" 
    :multiple="true"
    :close_on_select="false"
    :searchable="false"
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="user_id" 
    title="@lang('User')"
    :options="{{ $users }}" 
></i-multiselect>

{{-- <i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="payed" 
    title="@lang('Payed')"
    :value="false"
></i-checkbox> --}}

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="@lang('Description')"
></i-textarea>