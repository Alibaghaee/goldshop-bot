<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="log_name" title="Name"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="description" title="Description"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="causer_id" title="Causer ID"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="subject_id" title="Subject ID"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="ip" title="IP"></i-text-filter>

          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="hospital" 
            title="Hospital" 
            :options="getOptions('hospitals')"
          ></i-multiselect-filter>

          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="created_at_min" title="Date Min"></i-date-filter>
          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="created_at_max" title="Date Max"></i-date-filter>

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>