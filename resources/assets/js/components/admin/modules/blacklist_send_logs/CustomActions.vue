<template>
  <div class="flex justify-center -mx-1">

    <a class="rhc-btn rhc-btn-sm rhc-action-btn"
      :href="rowData.export_file_uri"
      v-html="icons.blacklist_list"
      target="_blank" 
      title="خروجی" 
    ></a>

  </div>
</template>

<script>
import CustomActionsMixin from './../../mixins/CustomActionsMixin'

export default {
  mixins: [CustomActionsMixin]
}
</script>
