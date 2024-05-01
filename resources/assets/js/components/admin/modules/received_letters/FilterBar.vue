<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="title" title="عنوان"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="description" title="توضیحات"></i-text-filter>

          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="date_min" title="تاریخ از"></i-date-filter>
          <i-date-filter :form_errors="form_errors" :form_data="form_data" name="date_max" title="تاریخ تا"></i-date-filter>

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>