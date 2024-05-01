<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="message" title="متن" :value="getUrlSearchParam('message')"></i-text-filter>

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="user_id" title="شناسه کاربر" :value="getUrlSearchParam('user_id')"></i-text-filter>

          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="status" 
            title="وضعیت" 
            :options="getOptions('status')"
            :value="getUrlSearchParam('status')"
          ></i-multiselect-filter>

          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="blacklist_type" 
            title="نوع درخواست" 
            :options="getOptions('blacklist_type')"
            :value="getUrlSearchParam('blacklist_type')"
          ></i-multiselect-filter>

          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="date_min" title="از تاریخ" :value="getUrlSearchParam('date_min')"></i-date-filter>
          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="date_max" title="تا تاریخ" :value="getUrlSearchParam('date_max')"></i-date-filter>


        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>