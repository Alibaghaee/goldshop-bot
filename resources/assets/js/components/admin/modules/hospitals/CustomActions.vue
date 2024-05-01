<template>
  <div class="flex justify-center -mx-1">

    <a class="rhc-btn rhc-action-btn"
      :href="rowData.impersonate_url"
      v-html="icons.login"
    ></a>

  </div>
</template>

<script>
import CustomActionsMixin from './../../mixins/CustomActionsMixin'

export default {
  mixins: [CustomActionsMixin]
}
</script>
