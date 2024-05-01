<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="entity_id"
    title="@lang('Bed')"
    :options="{{ $entities }}" 
    :value="{{ get_selected_option_from_array($entities->toArray(), $model->entity_id) }}"
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
    :value="{{ $model->items()->asOption() }}"
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="user_id" 
    title="@lang('User')"
    :options="{{ $users }}" 
    :value="{{ get_selected_option_from_array($users->toArray(), $model->user_id) }}"
></i-multiselect>

{{-- <i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="payed" 
    title="@lang('Payed')"
    :value="{{ $model->payed }}"
></i-checkbox> --}}

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="@lang('Description')"
    value="{{ $model->description }}"
></i-textarea>