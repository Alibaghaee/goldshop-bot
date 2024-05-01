<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="request_item_id" 
    title="@lang('Requested Service')"
    :options="{{ $request_items }}" 
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="admin_id" 
    title="@lang('Accepter')"
    :options="{{ $admins }}" 
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="status" 
    title="@lang('Status')"
    :options="{{ $status }}" 
    :value="{{ get_selected_option_from_array($status->toArray(), 0) }}"
></i-multiselect>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="@lang('Description')"
></i-textarea>