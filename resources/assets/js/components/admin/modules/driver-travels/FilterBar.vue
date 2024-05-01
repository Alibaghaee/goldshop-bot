<template>
      <filter-form-component :errors="errors" excel_export_endpoint="/travels/travels/export">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="beginning" title="مبدا"></i-text-filter>
          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="beginning_time_from" title="تاریخ رفت از"></i-date-filter>
          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="beginning_time_to" title="تاریخ رفت تا"></i-date-filter>
        <i-text-filter :form_errors="form_errors" :form_data="form_data" name="destination" title="مقصد"></i-text-filter>
        <i-date-filter :form_errors="form_errors" :form_data="form_data" name="time_return_from" title="تاریخ برگشت از"></i-date-filter>
        <i-date-filter :form_errors="form_errors" :form_data="form_data" name="time_return_to" title="تاریخ برگشت تا"></i-date-filter>


        <i-multiselect-filter
            :form_errors="form_errors"
            :form_data="form_data"
            name="reason"
            title="علت"
            :options="getOptions('reason_list')"
        ></i-multiselect-filter>

            <i-multiselect-filter
            :form_errors="form_errors"
            :form_data="form_data"
            name="status"
            title="وضعیت"
            :options="getOptions('status_list')"
        ></i-multiselect-filter>



        <i-text-filter :form_errors="form_errors" :form_data="form_data" name="subscrip_code" title="کداشتراک"></i-text-filter>
        <i-text-filter :form_errors="form_errors" :form_data="form_data" name="tracking_code" title="کدپیگیری"></i-text-filter>
        <i-text-filter :form_errors="form_errors" :form_data="form_data" name="username" title="نام کاربر"></i-text-filter>
        <i-text-filter :form_errors="form_errors" :form_data="form_data" name="drivername" title="نام راننده"></i-text-filter>

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>
