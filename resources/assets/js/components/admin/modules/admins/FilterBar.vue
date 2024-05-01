<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="name" title="عنوان"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="email" title="ایمیل"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="mobile" title="موبایل"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="username" title="نام کاربری"></i-text-filter>
          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="level" 
            title="سطح دسترسی" 
            :options="getOptions('levels')"
          ></i-multiselect-filter>
          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="role" 
            title="نقش کاربری" 
            :options="getOptions('levels')"
          ></i-multiselect-filter>

          <i-checkbox-filter :form_errors="form_errors" :form_data="form_data" name="status" title="وضعیت"></i-checkbox-filter>
          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="date" title="تاریخ"></i-date-filter>

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>