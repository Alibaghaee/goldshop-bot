<template>
      <filter-form-component :errors="errors" excel_export_endpoint="/sms_receives/sms_receives/export">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="id" title="شناسه"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="note" title="متن پیامک"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="sender" title="موبایل"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="receiver" title="سر شماره"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="sms_id" title="شناسه پیامک"></i-text-filter>

          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="status" 
            title="وضعیت پیامک" 
            :options="getOptions('status')"
          ></i-multiselect-filter>

          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="code_state" 
            title="وضعیت کد" 
            :options="getOptions('code_state')"
          ></i-multiselect-filter>

          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="product" 
            title="محصول" 
            :options="getOptions('products')"
          ></i-multiselect-filter>

          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="product_catgory" 
            title="دسته محصول" 
            :options="getOptions('product_categories')"
          ></i-multiselect-filter>

          <i-checkbox-filter :form_errors="form_errors" :form_data="form_data" name="ignored" title="وضعیت حذف"></i-checkbox-filter>
          
          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="created_at_min" title="تاریخ از"></i-date-filter>
          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="created_at_max" title="تاریخ تا"></i-date-filter>
          

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>