<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="title"
    title="عنوان"
    value="{{ $model->title }}"

></i-text>

<i-textarea
    :form="form"
    :form_data="form_data"
    name="description"
    title="متن"
    value="{{ $model->description }}"
></i-textarea>


{{--<i-multiselect--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="tag"--}}
{{--    title="تگ"--}}
{{--    :options="{{ get_option_from_array($tags) }}"--}}
{{--    :value="{{ json_encode(['id'=>0,'name'=>$model->tag]) }}"--}}
{{--></i-multiselect>--}}


