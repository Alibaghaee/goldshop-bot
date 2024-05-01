<i-multiselect
    :form="form"
    :form_data="form_data"
    name="user_id"
    title="کاربر"
    :options="{{$users}}"
    :value="{{ $model->user()->asOption() }}"
></i-multiselect>

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="driver_id"
    title="راننده"
    :options="{{$driver}}"
    :value="{{ $model->driver()->asOption() }}"
></i-multiselect>

<i-textarea
    :form="form"
    :form_data="form_data"
    name="beginning"
    title="مبدا"
    value="{{ $model->beginning }}"
></i-textarea>


<i-date
    :form="form"
    :form_data="form_data"
    name="beginning_time"
    title="ساعت رفت"
    value="{{ $model->beginning_time }}"
></i-date>


<i-textarea
    :form="form"
    :form_data="form_data"
    name="destination"
    title="مقصد"
    value="{{ $model->destination }}"
></i-textarea>


<i-date
    :form="form"
    :form_data="form_data"
    name="time_return"
    title="ساعت بازگشت"
    value="{{ $model->time_return }}"
></i-date>


<i-multiselect
    :form="form"
    :form_data="form_data"
    name="accompanying_person"
    title="همراه"
    :options="{{ get_option_from_array($accompanyingPersonList) }}"
    :value="{{ get_selected_option_from_array($accompanyingPersonList,\App\Models\General\Travel::transByTitleReason($model->accompanying_person,'accompanying_person') )  }}"
></i-multiselect>


<i-multiselect
    :form="form"
    :form_data="form_data"
    name="reason"
    title="علت"
    :options="{{ get_option_from_array($reasonList) }}"
    :value="{{ get_selected_option_from_array($reasonList,\App\Models\General\Travel::transByTitleReason($model->reason,'travel') )  }}"
></i-multiselect>


<i-multiselect
    :form="form"
    :form_data="form_data"
    name="status"
    title="وضعیت"
    :options="{{ get_option_from_array($statusList) }}"
    :value="{{ get_selected_option_from_array($statusList,$model->status)  }}"
></i-multiselect>
