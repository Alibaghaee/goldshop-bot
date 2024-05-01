<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="first_name" title="نام"></i-text-filter>
            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="last_name" title="نام خانوادگی"></i-text-filter>
            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="organization_code" title="کد کارگزینی"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="mobile" title="موبایل"></i-text-filter>


        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>
