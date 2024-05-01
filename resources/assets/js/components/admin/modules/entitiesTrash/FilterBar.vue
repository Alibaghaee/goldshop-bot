<template>
  <filter-form-component :errors="errors">
    <template slot="controls" slot-scope="{ form_errors, form_data }">

      <i-multiselect-filter
          :form_errors="form_errors"
          :form_data="form_data"
          name="department"
          title="Department"
          :options="getOptions('departments')"
      ></i-multiselect-filter>

      <i-multiselect-filter
          :form_errors="form_errors"
          :form_data="form_data"
          name="room"
          title="Room"
          :options="getOptions('rooms')"
      ></i-multiselect-filter>

      <i-text-filter :form_errors="form_errors" :form_data="form_data" name="title" title="Title"></i-text-filter>
      <i-text-filter :form_errors="form_errors" :form_data="form_data" name="description" title="Description"></i-text-filter>

      <i-multiselect-filter
          :form_errors="form_errors"
          :form_data="form_data"
          name="gender"
          title="Gender"
          :options="getOptions('genders')"
      ></i-multiselect-filter>

      <i-checkbox-filter :form_errors="form_errors" :form_data="form_data" name="active" title="Active"></i-checkbox-filter>

      <a :href="getQueryString('/entities/entities/export', form_data)" target="_blank" class="ml-auto rhc-btn rhc-btn-indigo mr-2 flex items-center" type="submit">
        <span>{{ $t('Export QR Codes') }}</span>
        <svg class="w-6 fill-current ml-2 align-middle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 480 320"><path d="M387.002 121.001C372.998 52.002 312.998 0 240 0c-57.998 0-107.998 32.998-132.998 81.001C47.002 87.002 0 137.998 0 200c0 65.996 53.999 120 120 120h260c55 0 100-45 100-100 0-52.998-40.996-96.001-92.998-98.999zM208 172V96h64v76h68L240 272 140 172h68z"/></svg>
      </a>

      <a :href="getQueryString('/entities/entities/exportLoginLinks', form_data)" target="_blank" class="ml-auto rhc-btn rhc-btn-indigo mr-2 flex items-center" type="submit">
        <span>{{ $t('Export login links') }}</span>
        <svg class="w-6 fill-current ml-2 align-middle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 480 320"><path d="M387.002 121.001C372.998 52.002 312.998 0 240 0c-57.998 0-107.998 32.998-132.998 81.001C47.002 87.002 0 137.998 0 200c0 65.996 53.999 120 120 120h260c55 0 100-45 100-100 0-52.998-40.996-96.001-92.998-98.999zM208 172V96h64v76h68L240 272 140 172h68z"/></svg>
      </a>

    </template>
  </filter-form-component>
</template>

<script>
import FilterBarMixin from './../../mixins/FilterBarMixin'

export default {
  mixins: [FilterBarMixin],
}

</script>