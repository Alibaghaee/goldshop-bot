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
    name="note" 
    title="متن پیام"
    value="{{ $model->note }}"
></i-textarea>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="database" 
    title="از طریق پنل کاربری"
    :value="{{ $model->database }}"
></i-checkbox>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="sms" 
    title="از طریق پیامک"
    :value="{{ $model->sms }}"
></i-checkbox>
