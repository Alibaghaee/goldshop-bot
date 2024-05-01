<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="from_admin_id" 
            title="ارجاع دهنده" 
            :options="getOptions('admins')"
          ></i-multiselect-filter>

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="description" title="توضیحات"></i-text-filter>

          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="created_at_min" title="از تاریخ"></i-date-filter>
          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="created_at_max" title="تا تاریخ"></i-date-filter>

          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="referred" 
            title="وضعیت" 
            :options="getOptions('refer_status')"
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