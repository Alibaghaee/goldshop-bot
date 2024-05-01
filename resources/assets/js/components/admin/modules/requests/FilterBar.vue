<template>
      <filter-form-component :errors="errors" excel_export_endpoint="/requests/requests/export">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

        <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="entity" 
            title="Bed"
            :options="getOptions('entities')"
        ></i-multiselect-filter>

        <i-text-filter :form_errors="form_errors" :form_data="form_data" name="id" title="Id"></i-text-filter>

        <i-date-filter :form_errors="form_errors" :form_data="form_data" name="date_from" title="Date From"></i-date-filter>
        <i-date-filter :form_errors="form_errors" :form_data="form_data" name="date_to" title="Date To"></i-date-filter>

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