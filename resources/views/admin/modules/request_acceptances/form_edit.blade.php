<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="request_item_id" 
    title="@lang('Requested Service')"
    :options="{{ $request_items }}" 
    :value="{{ get_selected_option_from_array($request_items->toArray(), $model->request_item_id) }}"
    :is_disabled="true"
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="admin_id" 
    title="@lang('Accepter')"
    :options="{{ $admins }}" 
    :value="{{ get_selected_option_from_array($admins->toArray(), $model->admin_id) }}"
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="status" 
    title="@lang('Status')"
    :options="{{ $status }}" 
    :value="{{ get_selected_option_from_array($status->toArray(), $model->status) }}"
></i-multiselect>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="@lang('Description')"
    value="{{ $model->description }}"
></i-textarea>