<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">
        
        <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="entity_item" 
            title="Request"
            :options="getOptions('entity_items')"
        ></i-multiselect-filter>

        <i-text-filter :form_errors="form_errors" :form_data="form_data" name="description" title="Description"></i-text-filter>

        <!-- <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="canceled" 
            title="Canceled"
            :options="getOptions('request_item_canceled_options')"
        ></i-multiselect-filter> -->

        <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="status" 
            title="Status"
            :options="getOptions('request_item_status_options')"
        ></i-multiselect-filter>

        <i-date-filter :form_errors="form_errors" :form_data="form_data" name="date_from" title="Date From"></i-date-filter>
        <i-date-filter :form_errors="form_errors" :form_data="form_data" name="date_to" title="Date To"></i-date-filter>

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>