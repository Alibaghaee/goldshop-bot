<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="code"
    title="کد"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="region"
    title="منطقه"
></i-text>


{{--<i-checkbox--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="mesh"--}}
{{--    title="مش"--}}
{{--></i-checkbox>--}}

{{--<i-checkbox--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="banner"--}}
{{--    title="تابلو"--}}
{{--></i-checkbox>--}}

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="visitor"
    title="بازدید کننده"
></i-text>

<i-date
    :form="form"
    :form_data="form_data"
    name="visit_date"
    title="تاریخ بازید"
    type="date"
></i-date>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="installer"
    title="نصب کننده"
></i-text>

<i-date
    :form="form"
    :form_data="form_data"
    name="install_date"
    title="تاریخ نصب"
    type="date"
></i-date>
<div class="border rounded p-2 ">
    <i-checkbox
        :form="form"
        :form_data="form_data"
        name="cerline"
        title="سرلاین"
    ></i-checkbox>
    <i-uploader
        :form="form"
        :form_data="form_data"
        name="cerline_image"
        title="تصویر سرلاین"
        action="{{ $model->store_uri }}"
        v-if="form_data.cerline"></i-uploader>
</div>

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="shop_available_products"
    title="محصولات موجود"
    :options="{{ $shop_available_products }}"
    group_label="name"
    group_values="items"
    :multiple="true"
    :close_on_select="false"
    :searchable="false"
></i-multiselect>

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="promotional_available_item"
    title="اقلام تبلیغاتی"
    :options="{{get_option_from_array($promotionalItems)}}"
    :multiple="true"
></i-multiselect>

<div v-if="form_data.promotional_available_item">
    <div
        v-for="item in form_data.promotional_available_item"
    >
        <div class="border rounded p-1 my-1">
            <i-promotional
                type="text"
                :form="form"
                :form_data="form_data"
                v-bind:name_="'promotional_available_item_ids.'+(item.id).toString()"
                v-bind:title="item.name"
            ></i-promotional>
        </div>
    </div>
</div>


<i-uploader
    :form="form"
    :form_data="form_data"
    name="image"
    title="تصویر"
    action="{{ $model->store_uri }}"
></i-uploader>

<i-textarea
    :form="form"
    :form_data="form_data"
    name="address"
    title="آدرس"
></i-textarea>

<i-input-map
    type="text"
    :form="form"
    :form_data="form_data"
    name="location"
    title="لوکیشن"
    value="35.67961,51.391726"
></i-input-map>
