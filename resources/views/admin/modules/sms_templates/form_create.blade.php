<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="title"
    title="عنوان"
></i-text>

<i-textarea
    :form="form"
    :form_data="form_data"
    name="description"
    title="متن"
></i-textarea>


<i-multiselect
    :form="form"
    :form_data="form_data"
    name="tag"
    title="تگ"
    :options="{{ get_option_from_array($tags) }}"
></i-multiselect>
