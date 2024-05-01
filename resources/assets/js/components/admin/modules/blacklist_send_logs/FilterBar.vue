<template>
      <filter-form-component :errors="errors">
        <template slot="controls" slot-scope="{ form_errors, form_data }">

          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="note" title="متن" :value="getUrlSearchParam('note')"></i-text-filter>
          <i-text-filter :form_errors="form_errors" :form_data="form_data" name="send_type" title="نحوه ارسال" :value="getUrlSearchParam('send_type')"></i-text-filter>

        </template>
      </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>