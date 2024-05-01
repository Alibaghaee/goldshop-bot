<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

        <i-text-filter :form_errors="form_errors" :form_data="form_data" name="title" title="Title"></i-text-filter>
        <i-text-filter :form_errors="form_errors" :form_data="form_data" name="description" title="Description"></i-text-filter>
        <i-multiselect-filter 
          :form_errors="form_errors" 
          :form_data="form_data" 
          name="priority" 
          title="Priority"
          :options="getOptions('service_priorities')"
        ></i-multiselect-filter>
        <i-multiselect-filter 
          :form_errors="form_errors" 
          :form_data="form_data" 
          name="type" 
          title="type"
          :options="getOptions('service_types')"
        ></i-multiselect-filter>
        <i-checkbox-filter :form_errors="form_errors" :form_data="form_data" name="active" title="Active"></i-checkbox-filter>

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>