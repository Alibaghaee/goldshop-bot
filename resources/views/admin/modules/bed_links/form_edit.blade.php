<i-text
        type="text"
        :form="form"
        :form_data="form_data"
        name="title"
        title="@lang('Title')"
        value="{{$model->title}}"
></i-text>


<i-text
        type="text"
        :form="form"
        :form_data="form_data"
        name="link"
        title="@lang('Link')"
        value="{{$model->link}}"
></i-text>


<i-checkbox
        :form="form"
        :form_data="form_data"
        name="active"
        title="@lang('Active')"
        :value="{{$model->active}}"
></i-checkbox>


<i-uploader
        :form="form"
        :form_data="form_data"
        name="icon"
        title="@lang('Icon')"
        action="{{ $model->store_uri }}"
        value="{{$model->icon}}"
></i-uploader>

