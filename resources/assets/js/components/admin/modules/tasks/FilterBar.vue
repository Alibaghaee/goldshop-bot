<template>
      <filter-form-component :errors="errors" excel_export_endpoint="/tasks/tasks/export">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="description" title="وظیفه"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="report_description" title="گزارش فعالیت"></i-text-filter>

          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="creator_admin" 
            title="ایجاد کننده" 
            :options="getOptions('admins')"
          ></i-multiselect-filter>

          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="assigned_to_admin" 
            title="دریافت کننده کننده" 
            :options="getOptions('admins')"
          ></i-multiselect-filter>

          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="report_status" 
            title="وضعیت گزارش" 
            :options="getOptions('report_status')"
          ></i-multiselect-filter>

          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="status" 
            title="وضعیت انجام کار" 
            :options="getOptions('task_status')"
          ></i-multiselect-filter>

          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="start_date_min" title="از تاریخ"></i-date-filter>
          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="start_date_max" title="تا تاریخ"></i-date-filter>

          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="deadline_min" title="تاریخ مهلت از"></i-date-filter>
          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="deadline_max" title="تاریخ مهلت تا"></i-date-filter>

          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="reported_at_min" title="تاریخ گزارش از"></i-date-filter>
          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="reported_at_max" title="تاریخ گزارش تا"></i-date-filter>

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>