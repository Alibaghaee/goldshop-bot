<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="title" title="Title"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="domain" title="Domain"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="description" title="Description"></i-text-filter>
          <i-checkbox-filter :form_errors="form_errors" :form_data="form_data" name="active" title="Active"></i-checkbox-filter>
          <i-checkbox-filter :form_errors="form_errors" :form_data="form_data" name="bed_has_main_menu" title="Bed has main menu"></i-checkbox-filter>
          <i-checkbox-filter :form_errors="form_errors" :form_data="form_data" name="bed_has_link_menu" title="Bed has link menu"></i-checkbox-filter>

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>