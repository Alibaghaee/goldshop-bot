<template>
  <div class="flex justify-center -mx-1">

    <a class="rhc-btn rhc-action-btn"
      @click="itemAction('delete')"
      v-html="icons.delete"
    ></a>

  </div>
</template>

<script>
import GlobalActionsMixin from './../mixins/GlobalActionsMixin'

export default {
  mixins: [GlobalActionsMixin]
}
</script>
