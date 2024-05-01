<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="fullname" title="نام و نام خانوادگی"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="mobile" title="موبایل"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="phone" title="تلفن"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="email" title="ایمیل"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="ip" title="آی پی"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="description" title="توضیحات"></i-text-filter>

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>