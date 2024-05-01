<i-text
        type="text"
        :form="form"
        :form_data="form_data"
        name="title"
        title="@lang('Title')"
></i-text>


<i-text
        type="text"
        :form="form"
        :form_data="form_data"
        name="link"
        title="@lang('Link')"
></i-text>


<i-checkbox
        :form="form"
        :form_data="form_data"
        name="active"
        title="@lang('Active')"
></i-checkbox>


<i-uploader
        :form="form"
        :form_data="form_data"
        name="icon"
        title="@lang('Icon')"
        action="{{ $model->store_uri }}"
></i-uploader>

