<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="payed" 
    title="وضعیت تراکنش"
    :options="{{ get_option_from_array($payment_status) }}" 
    :value="{{ get_selected_option_from_array($payment_status, $model->payed) }}"
></i-multiselect>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="status" 
    title="وضعیت رسیدگی"
    :options="{{ get_option_from_array($purchase_status) }}" 
    :value="{{ get_selected_option_from_array($purchase_status, $model->status) }}"
></i-multiselect>

<i-textarea 
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="توضیحات"
    value="{{ $model->description }}"
></i-textarea>