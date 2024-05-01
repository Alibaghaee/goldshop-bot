<template>
      <filter-form-component :errors="errors" excel_export_endpoint="/pays/pays/export">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="name" title="نام"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="family" title="نام خانوادگی"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="national_code" title="کد ملی"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="mobile" title="موبایل"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="phone" title="تلفن"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="emergency_mobile" title="تلفن تماس ضروری"></i-text-filter>
          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="grade" 
            title="مقطع تحصیلی" 
            :options="getOptions('grades')"
          ></i-multiselect-filter>
          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="field_of_study" 
            title="رشته تحصیلی" 
            :options="getOptions('fields_of_study')"
          ></i-multiselect-filter>
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
          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="gender" 
            title="جنسیت" 
            :options="getOptions('genders')"
          ></i-multiselect-filter>

          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="payment_subject" 
            title="موضوع پرداخت" 
            :options="getOptions('payment_subjects')"
          ></i-multiselect-filter>

          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="created_at_min" title="تاریخ تراکنش از"></i-date-filter>
          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="created_at_max" title="تاریخ تراکنش تا"></i-date-filter>

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="price" title="مبلغ"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="tracking_code" title="کد پیگیری"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="transaction_id" title="شناسه تراکنش"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="card_number" title="شماره کارت"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="description" title="شرح پرداخت"></i-text-filter>

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