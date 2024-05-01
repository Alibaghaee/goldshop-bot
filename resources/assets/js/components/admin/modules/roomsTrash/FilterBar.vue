<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="title" title="Title"></i-text-filter>

          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="department" 
            title="Department"
            :options="getOptions('departments')"
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