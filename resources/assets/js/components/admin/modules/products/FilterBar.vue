<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="title" title="عنوان"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="price" title="قیمت"></i-text-filter>
          <!-- <i-text-filter :form_errors="form_errors" :form_data="form_data" name="code" title="کد محصول"></i-text-filter> -->
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="description" title="توضیحات"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="detail" title="جزئیات"></i-text-filter>
          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="category" 
            title="گروه" 
            :options="getOptions('categories')"
            group_label="name"
            group_values="items"
          ></i-multiselect-filter>
          <!-- <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="locale"
            title="زبان" 
            :options="getOptions('locales')"
          ></i-multiselect-filter> -->
          <i-checkbox-filter :form_errors="form_errors" :form_data="form_data" name="active" title="وضعیت"></i-checkbox-filter>
          <i-checkbox-filter :form_errors="form_errors" :form_data="form_data" name="new" title="جدید"></i-checkbox-filter>

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>