<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="username" title="UserName"></i-text-filter>

          <i-multiselect-filter
            :form_errors="form_errors"
            :form_data="form_data"
            name="hospital"
            title="Hospital"
            :options="getOptions('hospitals')"
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
