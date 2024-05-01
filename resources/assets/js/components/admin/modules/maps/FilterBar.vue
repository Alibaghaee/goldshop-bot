<template>
    <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="code" title="کد"></i-text-filter>
            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="region"
                           title="منطقه"></i-text-filter>
            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="location"
                           title="طول و عرض  جغرافیایی"></i-text-filter>
<!--            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="location_y"-->
<!--                           title="عرض جغرافیایی"></i-text-filter>-->
            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="address"
                           title="آدرس"></i-text-filter>
            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="visitor"
                           title="بازدید کننده"></i-text-filter>
            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="installer"
                           title="نصب کننده"></i-text-filter>

<!--            <i-checkbox-filter :form_errors="form_errors" :form_data="form_data" name="mesh"-->
<!--                               title="مش"></i-checkbox-filter>-->
<!--            <i-checkbox-filter :form_errors="form_errors" :form_data="form_data" name="banner"-->
<!--                               title="تابلو"></i-checkbox-filter>-->
            <i-checkbox-filter :form_errors="form_errors" :form_data="form_data" name="cerline"
                               title="سرلاین"></i-checkbox-filter>

            <i-date-filter :form_errors="form_errors" :form_data="form_data" name="visit_date_min"
                           title="تاریخ بازدید از"></i-date-filter>
            <i-date-filter :form_errors="form_errors" :form_data="form_data" name="visit_date_max"
                           title="تاریخ بازدید تا"></i-date-filter>

            <i-date-filter :form_errors="form_errors" :form_data="form_data" name="install_date_min"
                           title="تاریخ نصب از"></i-date-filter>
            <i-date-filter :form_errors="form_errors" :form_data="form_data" name="install_date_max"
                           title="تاریخ نصب تا"></i-date-filter>


            <i-checkbox-filter  :form_errors="form_errors" :form_data="form_data" name="deleted_at"
                               title="سطل زباله"></i-checkbox-filter>

        </template>
    </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
    mixins: [FilterBarMixin],
}

</script>
