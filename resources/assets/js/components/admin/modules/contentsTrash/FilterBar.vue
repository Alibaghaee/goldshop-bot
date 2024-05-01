<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="title" title="Title"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="summary" title="Summary"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="body" title="Body"></i-text-filter>
          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="category" 
            title="Category" 
            :options="getOptions('categories')"
            group_label="name"
            group_values="items"
          ></i-multiselect-filter>
          <i-multiselect-filter 
            :form_errors="form_errors" 
            :form_data="form_data" 
            name="locale" 
            title="Language" 
            :options="getOptions('locales')"
          ></i-multiselect-filter>
          <i-checkbox-filter :form_errors="form_errors" :form_data="form_data" name="active" title="Active"></i-checkbox-filter>

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>