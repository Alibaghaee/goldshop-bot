<template>
  <div class="flex justify-center -mx-1">

    <a class="rhc-btn rhc-action-btn" 
      :href="rowData.edit_uri"
      v-html="icons.edit"
    ></a>

  </div>
</template>

<script>
import GlobalActionsMixin from './../../mixins/GlobalActionsMixin'

export default {
  mixins: [GlobalActionsMixin]
}
</script>
