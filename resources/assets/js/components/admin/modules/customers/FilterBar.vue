<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

            <i-multiselect-filter 
              :form_errors="form_errors" 
              :form_data="form_data" 
              name="type" 
              title="نوع" 
              :options="getOptions('types')"
            ></i-multiselect-filter>
            
            <i-multiselect-filter 
              :form_errors="form_errors" 
              :form_data="form_data" 
              name="group" 
              title="گروه" 
          :options="getOptions('groups')"
            ></i-multiselect-filter>

            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="name" title="نام"></i-text-filter>
            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="family" title="نام خانوادگی"></i-text-filter>
            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="company_name" title="نام شرکت"></i-text-filter>
            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="email" title="ایمیل"></i-text-filter>
            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="phone" title="تلفن"></i-text-filter>
            <i-text-filter :form_errors="form_errors" :form_data="form_data" name="mobile" title="موبایل"></i-text-filter>

            <i-date-filter :form_errors="form_errors" :form_data="form_data" name="created_at_min" title="تاریخ ایجاد از"></i-date-filter>
            <i-date-filter :form_errors="form_errors" :form_data="form_data" name="created_at_max" title="تاریخ ایجاد تا"></i-date-filter>

            <i-multiselect-filter 
              :form_errors="form_errors" 
              :form_data="form_data" 
              name="creator" 
              title="ایجاد کننده" 
              :options="getOptions('admins')"
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