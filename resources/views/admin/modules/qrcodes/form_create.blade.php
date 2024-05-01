
<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="bg_color"
    title="@lang('Background Color')"
    value="{{ $qrcode['bg_color'] }}"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="front_title"
    title="@lang('Front Title')"
    value="{{ $qrcode['front_title'] }}"

></i-text>

<i-textarea
    :form="form"
    :form_data="form_data"
    name="front_txt"
    title="@lang('Front Text')"
    value="{{ $qrcode['front_txt'] }}"
></i-textarea>

<i-textarea
    :form="form"
    :form_data="form_data"
    name="front_txt_big"
    title="@lang('Front Text For Big Size (1 in A3 , 1 in A4)')"
    value="{{ $qrcode['front_txt_big'] }}"
></i-textarea>


<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="back_title"
    title="@lang('Back Title')"
    value="{{ $qrcode['back_title'] }}"
></i-text>

<i-textarea
    :form="form"
    :form_data="form_data"
    name="back_txt"
    title="@lang('Back Text')"
    value="{{ $qrcode['back_txt'] }}"
></i-textarea>


<i-uploader
    :form="form"
    :form_data="form_data"
    name="logo"
    title="@lang('Logo')"
    action="{{ $model->store_uri }}"
    value="{{ $qrcode['logo'] }}"
></i-uploader>

<i-uploader
    :form="form"
    :form_data="form_data"
    name="logo_a3"
    title="@lang('Big Size (1 in A3 , 1 in A4) Logo')"
    action="{{ $model->store_uri }}"
    value="{{ $qrcode['logo_a3'] }}"
></i-uploader>

<i-uploader
    :form="form"
    :form_data="form_data"
    name="logo_a3_top"
    title="@lang('Big Size (1 in A3 , 1 in A4) Top Logo')"
    action="{{ $model->store_uri }}"
    value="{{ $qrcode['logo_a3_top'] }}"
></i-uploader>

<i-uploader
    :form="form"
    :form_data="form_data"
    name="nurse"
    title="@lang('Bild')"
    action="{{ $model->store_uri }}"
    value="{{ $qrcode['nurse'] }}"
></i-uploader>

<i-uploader
    :form="form"
    :form_data="form_data"
    name="nurse_a3"
    title="@lang('Bild Big Size (1 in A3 , 1 in A4)')"
    action="{{ $model->store_uri }}"
    value="{{ $qrcode['nurse_a3'] }}"
></i-uploader>
