{{-- <i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="category_item_id" 
    title="گروه *"
    :options="{{ $categories }}" 
    group_label="name"
    group_values="items"
></i-multiselect> --}}

{{-- <i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="locale_id" 
    title="زبان"
    :options="{{ get_option_from_array($locales) }}" 
></i-multiselect> --}}

<i-multiselect 
    :form="form" 
    :form_data="form_data" 
    name="fields" 
    title="رشته تحصیلی"
    :options="{{ get_option_from_array($fields) }}" 
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
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="address_slug" 
    title="عنوان (uri)"
></i-text>

<i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="title" 
    title="عنوان (H1)"
></i-text>

{{-- <i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="code" 
    title="کد محصول"
></i-text> --}}

{{-- <i-text 
    type="text" 
    :form="form" 
    :form_data="form_data" 
    name="price" 
    title="قیمت"
></i-text> --}}

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="description" 
    title="توضیحات"
></i-textarea>

<i-textarea 
    :advance_editor="true"
    :form="form" 
    :form_data="form_data" 
    name="detail" 
    title="جزئیات"
></i-textarea>
<small>هر خط یک مورد</small>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="new" 
    title="محصول منتخب"
></i-checkbox>

<i-checkbox 
    :form="form" 
    :form_data="form_data" 
    name="active" 
    title="وضعیت نمایش"
></i-checkbox>

<i-uploader 
    :form="form" 
    :form_data="form_data" 
    name="image" 
    title="تصویر"
    action="{{ $model->store_uri }}" 
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
    :value="[]"
></i-tag-multiselect>
