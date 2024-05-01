<template>
      <filter-form-component :errors="errors" excel_export_endpoint="/purchases/purchases/export">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="title" title="عنوان"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="price" title="مبلغ"></i-text-filter>

          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="created_at_min" title="تاریخ تراکنش از"></i-date-filter>
          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="created_at_max" title="تاریخ تراکنش تا"></i-date-filter>

<!--          <i-multiselect-filter -->
<!--            :form_errors="form_errors" -->
<!--            :form_data="form_data" -->
<!--            name="package" -->
<!--            title="پکیج" -->
<!--            :options="getOptions('packages')"-->
<!--          ></i-multiselect-filter>-->

          <i-multiselect-filter
            :form_errors="form_errors"
            :form_data="form_data"
            name="user"
            title="پرداخت کننده"
            :options="getOptions('users')"
          ></i-multiselect-filter>

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="tracking_code" title="کد پیگیری"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="transaction_id" title="شناسه تراکنش"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="card_number" title="شماره کارت"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="description" title="توضیحات"></i-text-filter>

          <i-multiselect-filter
            :form_errors="form_errors"
            :form_data="form_data"
            name="status"
            title="وضعیت رسیدگی"
            :options="getOptions('status')"
          ></i-multiselect-filter>

          <i-checkbox-filter :form_errors="form_errors" :form_data="form_data" name="payed" title="وضعیت پرداخت کل"></i-checkbox-filter>

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>
