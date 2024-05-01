<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="home"
    title="Home"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="robot_hardware_serial_number"
    title="Serial number"
></i-text>




<i-multiselect
    :form="form"
    :form_data="form_data"
    name="status"
    title="Status"
    :options="{{ $status }}"
></i-multiselect>

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="task_status"
    title="Task status"
    :options="{{ $taskStatus }}"
></i-multiselect>

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="task_type"
    title="Task type"
    :options="{{ $taskType }}"
></i-multiselect>
