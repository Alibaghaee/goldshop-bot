<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="name" title="Name"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="email" title="Email"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="mobile" title="Mobile"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="username" title="Username"></i-text-filter>
          <i-checkbox-filter :form_errors="form_errors" :form_data="form_data" name="status" title="Status"></i-checkbox-filter>
          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="date" title="Date"></i-date-filter>

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>