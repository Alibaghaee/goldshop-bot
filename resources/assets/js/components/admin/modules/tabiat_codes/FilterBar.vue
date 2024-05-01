<template>
      <filter-form-component :errors="errors" excel_export_endpoint="/tabiat_codes/tabiat_codes/export">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <!-- <i-text-filter :form_errors="form_errors" :form_data="form_data" name="refrence_id" title="شناسه پیگیری"></i-text-filter> -->

          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="tabiat_product" 
            title="محصول" 
            :options="getOptions('tabiat_products')"
          ></i-multiselect-filter>

          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="status" 
            title="وضعیت کد" 
            :options="getOptions('status')"
          ></i-multiselect-filter>

          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="utilization_date_min" title="تاریخ استفاده از"></i-date-filter>
          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="utilization_date_max" title="تاریخ استفاده تا"></i-date-filter>
          
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="code" title="کد"></i-text-filter>

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>