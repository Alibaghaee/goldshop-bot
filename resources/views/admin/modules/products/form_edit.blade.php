{{-- <i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="category_item_id" 
    title="گروه *"
    :options="{{ $categories }}" 
    group_label="name"
    group_values="items"
    :value="{{ $category_items->where('id', $model->category_item_id)->first() }}"
></i-multiselect> --}}

{{-- <i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="locale_id" 
    title="زبان"
    :options="{{ get_option_from_array($locales) }}" 
    :value="{{ get_selected_option_from_array($locales, $model->locale_id) }}"
></i-multiselect> --}}

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="fields"
    title="رشته تحصیلی"
    :options="{{ get_option_from_array($fields) }}" 
    :value="{{ $model->fields()->asOption() }}"
    :multiple="true"
    :close_on_select="false"
    :searchable="false"
></i-multiselect>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="html_title" 
    title="عنوان (title) *"
    value="{{ $model->html_title }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="address_slug" 
    title="عنوان (uri)"
    value="{{ $model->address_slug }}"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="عنوان (H1)"
    value="{{ $model->title }}"
></i-text>

{{-- <i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="code" 
    title="کد محصول"
    value="{{ $model->code }}"
></i-text> --}}

{{-- <i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="price" 
    title="قیمت"
    value="{{ $model->price }}"
></i-text> --}}

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="توضیحات"
    value="{{ $model->description }}"
></i-textarea>

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="detail" 
    title="جزئیات"
    value="{{ $model->detail }}"
></i-textarea>
<small>هر خط یک مورد</small>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="new" 
    title="محصول منتخب"
    :value="{{ $model->new }}" 
></i-checkbox>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="active" 
    title="وضعیت نمایش"
    :value="{{ $model->active }}" 
></i-checkbox>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="image" 
    title="تصویر"
    action="{{ $model->store_uri }}" 
    value="{{ $model->image }}"
></i-uploader>

<i-tag-multiselect 
    :form="form" 
    :form_data="form_data" 
    tag_placeholder="به عنوان برچسب جدید اضافه کن" 
    placeholder="جستجو یا اضافه کردن برچسب" 
    name="tags" 
    title="برچسب"
    :options="{{ $tags }}" 
    :multiple="true" 
    :taggable="true"
    tag_function="addTag"
    :value="{{ $model->tags()->asOption() }}" 
></i-tag-multiselect>

