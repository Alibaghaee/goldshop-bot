<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

            <i-multiselect-filter 
              :form_errors="form_errors" 
              :form_data="form_data" 
              name="customer" 
              title="مشتری" 
              :options="getOptions('customers')"
            ></i-multiselect-filter>

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="title" title="عنوان"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="description" title="توضیح"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="body" title="متن"></i-text-filter>

          <i-checkbox-filter :form_errors="form_errors" :form_data="form_data" name="is_pattern" title="الگو"></i-checkbox-filter>

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>