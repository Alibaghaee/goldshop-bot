<template>
  <div class="flex justify-center -mx-1">

    <a class="rhc-btn rhc-action-btn bg-blue"
       :href="rowData.restore_update_url"
       v-html="icons.restore"
    ></a>




  </div>
</template>

<script>
import CustomActionsMixin from './../../mixins/CustomActionsMixin'

export default {
  mixins: [CustomActionsMixin]
}
</script>
