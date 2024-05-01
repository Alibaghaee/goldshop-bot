<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="expert_id" 
    title="متخصص"
    :options="{{ $experts }}" 
></i-multiselect>

<i-date 
    :form="form" 
    :form_data="form_data" 
    name="start_date" 
    title="تاریخ شروع"
></i-date>

<i-date 
    :form="form" 
    :form_data="form_data" 
    name="end_date" 
    title="تاریخ پایان"
></i-date>

<br>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="saturday_status" 
    title="شنبه"
></i-checkbox>

<i-time 
    :form="form" 
    :form_data="form_data" 
    name="saturday_start_time" 
    title="ساعت شروع"
></i-time>

<i-time 
    :form="form" 
    :form_data="form_data" 
    name="saturday_end_time" 
    title="ساعت پایان"
></i-time>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="saturday_room" 
    title="اتاق"
    :options="{{ $rooms }}" 
></i-multiselect>

<br>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="sunday_status" 
    title="یکشنبه"
></i-checkbox>

<i-time 
    :form="form" 
    :form_data="form_data" 
    name="sunday_start_time" 
    title="ساعت شروع"
></i-time>

<i-time 
    :form="form" 
    :form_data="form_data" 
    name="sunday_end_time" 
    title="ساعت پایان"
></i-time>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="sunday_room" 
    title="اتاق"
    :options="{{ $rooms }}" 
></i-multiselect>

<br>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="monday_status" 
    title="دوشنبه"
></i-checkbox>

<i-time 
    :form="form" 
    :form_data="form_data" 
    name="monday_start_time" 
    title="ساعت شروع"
></i-time>

<i-time 
    :form="form" 
    :form_data="form_data" 
    name="monday_end_time" 
    title="ساعت پایان"
></i-time>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="monday_room" 
    title="اتاق"
    :options="{{ $rooms }}" 
></i-multiselect>

<br>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="tuesday_status" 
    title="سه شنبه"
></i-checkbox>

<i-time 
    :form="form" 
    :form_data="form_data" 
    name="tuesday_start_time" 
    title="ساعت شروع"
></i-time>

<i-time 
    :form="form" 
    :form_data="form_data" 
    name="tuesday_end_time" 
    title="ساعت پایان"
></i-time>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="tuesday_room" 
    title="اتاق"
    :options="{{ $rooms }}" 
></i-multiselect>

<br>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="wednesday_status" 
    title="چهارشنبه"
></i-checkbox>

<i-time 
    :form="form" 
    :form_data="form_data" 
    name="wednesday_start_time" 
    title="ساعت شروع"
></i-time>

<i-time 
    :form="form" 
    :form_data="form_data" 
    name="wednesday_end_time" 
    title="ساعت پایان"
></i-time>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="wednesday_room" 
    title="اتاق"
    :options="{{ $rooms }}" 
></i-multiselect>

<br>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="thursday_status" 
    title="پنج شنبه"
></i-checkbox>

<i-time 
    :form="form" 
    :form_data="form_data" 
    name="thursday_start_time" 
    title="ساعت شروع"
></i-time>

<i-time 
    :form="form" 
    :form_data="form_data" 
    name="thursday_end_time" 
    title="ساعت پایان"
></i-time>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="thursday_room" 
    title="اتاق"
    :options="{{ $rooms }}" 
></i-multiselect>

<br>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="friday_status" 
    title="جمعه"
></i-checkbox>

<i-time 
    :form="form" 
    :form_data="form_data" 
    name="friday_start_time" 
    title="ساعت شروع"
></i-time>

<i-time 
    :form="form" 
    :form_data="form_data" 
    name="friday_end_time" 
    title="ساعت پایان"
></i-time>

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="friday_room" 
    title="اتاق"
    :options="{{ $rooms }}" 
></i-multiselect>
