<i-multiselect
    :form="form"
    :form_data="form_data"
    name="category_item_id"
    title="گروه *"
    :options="{{ $categories }}"
    group_label="name"
    group_values="items"
></i-multiselect>


<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="html_title"
    title="عنوان (title) *"
></i-text>


<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="title"
    title="عنوان (H1)"
></i-text>

{{--<i-text--}}
{{--    type="text"--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="title_en"--}}
{{--    title="عنوان انگلیسی (H1)"--}}
{{--></i-text>--}}

<i-textarea
    :advance_editor="false"
    :form="form"
    :form_data="form_data"
    name="summary"
    title="خلاصه"
></i-textarea>

{{--<i-textarea--}}
{{--    :advance_editor="false"--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="summary_en"--}}
{{--    title="خلاصه انگلیسی"--}}
{{--></i-textarea>--}}

<i-textarea
    :advance_editor="true"
    :form="form"
    :form_data="form_data"
    name="body"
    title="متن"
></i-textarea>

{{--<i-textarea--}}
{{--    :advance_editor="true"--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="body_en"--}}
{{--    title="متن انگلیسی"--}}
{{--></i-textarea>--}}

<i-checkbox
    :form="form"
    :form_data="form_data"
    name="active"
    title="وضعیت نمایش"
></i-checkbox>


{{--<i-date--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="publish_date"--}}
{{--    title="تاریخ انتشار"--}}
{{--    format="YYYY-MM-DD"--}}

{{--></i-date>--}}

{{--<i-date--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="expire_date"--}}
{{--    title="تاریخ انقضا"--}}
{{--    format="YYYY-MM-DD"--}}

{{--></i-date>--}}


<i-uploader
    :form="form"
    :form_data="form_data"
    name="image"
    title="تصویر"
    action="{{ $model->store_uri }}"
></i-uploader>

<i-uploader
    :form="form"
    :form_data="form_data"
    name="image2"
    title="تصویر دوم"
    action="{{ $model->store_uri }}"
></i-uploader>

<i-uploader
    :form="form"
    :form_data="form_data"
    name="image3"
    title="تصویر سوم"
    action="{{ $model->store_uri }}"
></i-uploader>

<i-uploader
    :form="form"
    :form_data="form_data"
    name="file"
    title="فایل ضمیمه"
    action="{{ $model->store_uri }}"
></i-uploader>
