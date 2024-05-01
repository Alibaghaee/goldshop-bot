<i-multiselect
    :form="form"
    :form_data="form_data"
    name="user_id"
    title="کاربر"
    :options="{{$users}}"
></i-multiselect>


<i-multiselect
    :form="form"
    :form_data="form_data"
    name="driver_id"
    title="راننده"
    :options="{{$driver}}"
></i-multiselect>



<i-textarea
    :form="form"
    :form_data="form_data"
    name="beginning"
    title="مبدا"
></i-textarea>


<i-date
    :form="form"
    :form_data="form_data"
    name="beginning_time"
    title="ساعت رفت"
></i-date>


<i-textarea
    :form="form"
    :form_data="form_data"
    name="destination"
    title="مقصد"
></i-textarea>


<i-date
    :form="form"
    :form_data="form_data"
    name="time_return"
    title="ساعت بازگشت"
></i-date>




<i-multiselect
    :form="form"
    :form_data="form_data"
    name="accompanying_person"
    title="همراه"
    :options="{{ get_option_from_array($accompanyingPersonList) }}"
></i-multiselect>


<i-multiselect
    :form="form"
    :form_data="form_data"
    name="reason"
    title="علت"
    :options="{{ get_option_from_array($reasonList) }}"
></i-multiselect>




<i-multiselect
    :form="form"
    :form_data="form_data"
    name="status"
    title="وضعیت"
    :options="{{ get_option_from_array($statusList) }}"
 ></i-multiselect>
