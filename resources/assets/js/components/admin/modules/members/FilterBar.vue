<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="name" title="نام"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="family" title="نام خانوادگی"></i-text-filter>

          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="province" 
            title="استان" 
            :options="getOptions('provinces')"
          ></i-multiselect-filter>

          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="city" 
            title="شهر" 
            :options="getOptions('cities')"
          ></i-multiselect-filter>

          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="birth_date_min" title="تاریخ تولد از"></i-date-filter>
          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="birth_date_max" title="تاریخ تولد تا"></i-date-filter>

          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="created_at_min" title="تاریخ ثبت از"></i-date-filter>
          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="created_at_max" title="تاریخ ثبت تا"></i-date-filter>

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="mobile" title="موبایل"></i-text-filter>

          <i-checkbox-filter :form_errors="form_errors" :form_data="form_data" name="complete" title="تکمیل"></i-checkbox-filter>
          <i-checkbox-filter :form_errors="form_errors" :form_data="form_data" name="blacklist" title="حذف شده"></i-checkbox-filter>

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>