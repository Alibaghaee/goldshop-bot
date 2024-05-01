<template>
      <filter-form-component :errors="errors" excel_export_endpoint="/users/users/export">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="name" title="نام"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="family" title="نام خانوادگی"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="mobile" title="موبایل"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="second_mobile" title="موبایل دوم"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="phone" title="تلفن"></i-text-filter>
          <!-- <i-multiselect-filter
            :form_errors="form_errors"
            :form_data="form_data"
            name="refund_filters_status"
            title="وضعیت بازگشت هزینه"
            :options="getOptions('refund_filters_status')"
          ></i-multiselect-filter> -->
<!--          <i-multiselect-filter-->
<!--            :form_errors="form_errors"-->
<!--            :form_data="form_data"-->
<!--            name="package"-->
<!--            title="پکیج"-->
<!--            :options="getOptions('packages')"-->
<!--          ></i-multiselect-filter>-->
          <i-multiselect-filter
            :form_errors="form_errors"
            :form_data="form_data"
            name="payment_filters_status"
            title="وضعیت پرداخت"
            :options="getOptions('payment_filters_status')"
          ></i-multiselect-filter>
<!--          <i-multiselect-filter-->
<!--            :form_errors="form_errors"-->
<!--            :form_data="form_data"-->
<!--            name="grade"-->
<!--            title="مقطع تحصیلی"-->
<!--            :options="getOptions('grades')"-->
<!--          ></i-multiselect-filter>-->
<!--          <i-multiselect-filter-->
<!--            :form_errors="form_errors"-->
<!--            :form_data="form_data"-->
<!--            name="field_of_study"-->
<!--            title="رشته تحصیلی"-->
<!--            :options="getOptions('fields_of_study')"-->
<!--          ></i-multiselect-filter>-->
          <i-multiselect-filter
            :form_errors="form_errors"
            :form_data="form_data"
            name="gender"
            title="جنسیت"
            :options="getOptions('genders')"
          ></i-multiselect-filter>
<!--          <i-multiselect-filter-->
<!--            :form_errors="form_errors"-->
<!--            :form_data="form_data"-->
<!--            name="field"-->
<!--            title="رشته کنکورسراسری"-->
<!--            :options="getOptions('fields')"-->
<!--          ></i-multiselect-filter>-->
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
          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="created_at_min" title="تاریخ ثبت کاربر از"></i-date-filter>
          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="created_at_max" title="تاریخ ثبت کاربر تا"></i-date-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="address" title="آدرس"></i-text-filter>

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="subscrip_code" title="کد اشتراک"></i-text-filter>
<!--          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="national_code" title="کد ملی"></i-text-filter>-->

          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="payment_created_at_min" title="تاریخ تراکنش از"></i-date-filter>
          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="payment_created_at_max" title="تاریخ تراکنش تا"></i-date-filter>
<!--          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="emergency_mobile" title="تلفن تماس ضروری"></i-text-filter>-->

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>
