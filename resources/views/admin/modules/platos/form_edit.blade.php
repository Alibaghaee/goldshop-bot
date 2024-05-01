<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="home"
    title="Home"
    value="{{$model->home}}"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="robot_hardware_serial_number"
    title="Serial number"
    value="{{$model->robot_hardware_serial_number}}"
></i-text>


<i-multiselect
    :form="form"
    :form_data="form_data"
    name="status"
    title="Status"
    :options="{{ $status }}"
    :value="{{ get_selected_option_from_array($status->toArray(), $model->status) }}"
></i-multiselect>

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="task_status"
    title="Task status"
    :options="{{ $taskStatus }}"
    :value="{{ get_selected_option_from_array($taskStatus->toArray(), $model->task_status) }}"

></i-multiselect>

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="task_type"
    title="Task type"
    :options="{{ $taskType }}"
    :value="{{ get_selected_option_from_array($taskType->toArray(), $model->task_type) }}"

></i-multiselect>
