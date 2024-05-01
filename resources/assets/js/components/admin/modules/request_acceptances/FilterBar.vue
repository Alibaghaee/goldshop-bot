<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-multiselect-filter 
              :form_errors="form_errors" 
              :form_data="form_data" 
              name="status" 
              title="Status"
              :options="getOptions('request_acceptance_status_options')"
          ></i-multiselect-filter>

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="id" title="Id"></i-text-filter>

          <i-multiselect-filter 
              :form_errors="form_errors" 
              :form_data="form_data" 
              name="admin" 
              title="Accepter"
              :options="getOptions('admins')"
          ></i-multiselect-filter>

          <i-multiselect-filter 
              :form_errors="form_errors" 
              :form_data="form_data" 
              name="request_item" 
              title="Request"
              :options="getOptions('request_items')"
          ></i-multiselect-filter>

          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="accept_date_from" title="Accept Date From"></i-date-filter>
          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="accept_date_to" title="Accept Date To"></i-date-filter>

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="description" title="Description"></i-text-filter>

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>