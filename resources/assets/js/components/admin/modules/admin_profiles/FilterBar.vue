<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="name" title="نام"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="username" title="نام کاربری"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="email" title="ایمیل"></i-text-filter>

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>
