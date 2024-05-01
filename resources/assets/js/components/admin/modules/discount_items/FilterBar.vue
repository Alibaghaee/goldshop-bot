<template>
      <filter-form-component :errors="errors" :excel_export_endpoint="options.excel_export_endpoint">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="code" title="کد"></i-text-filter>
          <i-checkbox-filter :form_errors="form_errors" :form_data="form_data" name="valid" title="وضعیت کد"></i-checkbox-filter>

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>