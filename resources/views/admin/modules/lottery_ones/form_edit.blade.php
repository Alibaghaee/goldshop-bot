<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="عنوان"
    value="{{ $model->title }}" 
    ></i-text>
    
    <i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="step" 
    title="مرحله"
    value="{{ $model->step }}" 
    ></i-text>
    
    <i-date 
    :form="form" 
    :form_data="form_data" 
    name="date" 
    title="تا تاریخ"
    value="{{ $model->date }}" 
    ></i-date>