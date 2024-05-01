<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

            <i-date-filter :form_errors="form_errors" :form_data="form_data" name="entry_date_min" title="تاریخ ورود از"></i-date-filter>
            <i-date-filter :form_errors="form_errors" :form_data="form_data" name="entry_date_max" title="تاریخ ورود تا"></i-date-filter>

            <i-multiselect-filter 
              :form_errors="form_errors" 
              :form_data="form_data" 
              name="admin" 
              title="کاربر" 
              :options="getOptions('admins')"
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