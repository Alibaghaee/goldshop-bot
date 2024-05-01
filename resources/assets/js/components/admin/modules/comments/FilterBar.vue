<template>
    <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">


            <!--            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="title"-->
            <!--                           title="عنوان"></i-text-filter>-->
            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="description"
                           title="متن"></i-text-filter>

            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="user"
                           title="کاربر"></i-text-filter>

            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="admin"
                           title="ادمین"></i-text-filter>


            <i-multiselect-filter
                :form_errors="form_errors"
                :form_data="form_data"
                name="statusJson"
                title="وضعیت"
                :options="getOptions('status')"
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
