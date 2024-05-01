<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="code"
    title="کد"
    value="{{ $model->code }}"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="region"
    title="منطقه"
    value="{{ $model->region }}"
></i-text>


{{--<i-checkbox--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="mesh"--}}
{{--    title="مش"--}}
{{--    :value="{{ $model->mesh }}"--}}
{{--></i-checkbox>--}}

{{--<i-checkbox--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="banner"--}}
{{--    title="تابلو"--}}
{{--    :value="{{ $model->banner }}"--}}
{{--></i-checkbox>--}}

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="visitor"
    title="بازدید کننده"
    value="{{ $model->visitor }}"
></i-text>

<i-date
    :form="form"
    :form_data="form_data"
    name="visit_date"
    title="تاریخ بازید"
    value="{{ $model->visit_date }}"
></i-date>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="installer"
    title="نصب کننده"
    value="{{ $model->installer }}"
></i-text>

<i-date
    :form="form"
    :form_data="form_data"
    name="install_date"
    title="تاریخ نصب"
    value="{{ $model->install_date }}"
></i-date>

<div class="border rounded p-2 ">
    <i-checkbox
        :form="form"
        :form_data="form_data"
        name="cerline"
        title="سرلاین"
        :value="{{ $model->cerline }}"
    ></i-checkbox>
    <i-uploader
        :form="form"
        :form_data="form_data"
        name="cerline_image"
        title="تصویر سرلاین"
        value="{{ $model->cerline_image }}"
        action="{{ $model->store_uri }}"
        v-if="form_data.cerline" ></i-uploader>
</div>
<i-multiselect
    :form="form"
    :form_data="form_data"
    name="shop_available_products"
    title="محصولات موجود"
    :options="{{$shop_available_products}}"
    :multiple="true"
    group_label="name"
    group_values="items"
    :close_on_select="false"
    :searchable="false"
    :value="{{json_encode($model->shop_available_products) }}"
></i-multiselect>


<i-multiselect
    :form="form"
    :form_data="form_data"
    name="promotional_available_item"
    title="اقلام تبلیغاتی"
    :options="{{get_option_from_array($promotionalItems)}}"
    :multiple="true"

    :value="{{json_encode($model->promotional_available_item) }}"
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
                :promotional_available_item_values="{{ collect($model->promotional_available_item_values)}}"
                v-bind:editable="true"
            ></i-promotional>
        </div>
    </div>
</div>


<i-uploader
    :form="form"
    :form_data="form_data"
    name="image"
    title="تصویر"
    value="{{ $model->image }}"
    action="{{ $model->store_uri }}"
></i-uploader>


<i-textarea
    :form="form"
    :form_data="form_data"
    name="address"
    title="آدرس"
    value="{{ $model->address }}"
></i-textarea>


<i-input-map
    type="text"
    :form="form"
    :form_data="form_data"
    name="location"
    title="لوکیشن"
    value="{{ $model->lat_long }}"
></i-input-map>
