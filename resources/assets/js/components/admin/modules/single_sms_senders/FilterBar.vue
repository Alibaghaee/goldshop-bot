<template>
    <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="description"
                           title="متن"></i-text-filter>


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
                name="type"
                title="نوع"
                :options="getOptions('type_list')"
            ></i-multiselect-filter>

            <i-multiselect-filter
                :form_errors="form_errors"
                :form_data="form_data"
                name="contactNumber"
                title="مخاطب"
                :options="getOptions('contact_number_list')"
            ></i-multiselect-filter>

            <i-multiselect-filter
                :form_errors="form_errors"
                :form_data="form_data"
                name="senderNumber"
                title="ارسال کننده"
                :options="getOptions('sender_number_list')"
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
