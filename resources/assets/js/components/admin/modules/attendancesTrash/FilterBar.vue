<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-multiselect-filter 
              :form_errors="form_errors" 
              :form_data="form_data" 
              name="admin" 
              title="Fullname"
              :options="getOptions('admins')"
          ></i-multiselect-filter>

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>