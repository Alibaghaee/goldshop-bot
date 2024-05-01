<template>
    <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="title" title="عنوان"></i-text-filter>

            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="mobile"
                           title="موبایل"></i-text-filter>
            <i-multiselect-filter
                :form_errors="form_errors"
                :form_data="form_data"
                name="status"
                title="وضعیت"
                :options="getOptions('status_list')"
            ></i-multiselect-filter>

            <i-multiselect-filter
                :form_errors="form_errors"
                :form_data="form_data"
                name="panelSms"
                title="پنل"
                :options="getOptions('panel_list')"
            ></i-multiselect-filter>
        </template>
    </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
    mixins: [FilterBarMixin],
}

</script>
