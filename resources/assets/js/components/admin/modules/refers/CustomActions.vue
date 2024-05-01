<template>
  <div class="flex justify-center -mx-1">

    <a class="rhc-btn rhc-action-btn" v-if="!rowData.referred"
      :href="rowData.edit_uri"
      v-html="icons.refer"
      title="ارجاع" 
    ></a>

    <a class="rhc-btn rhc-action-btn" v-if="!rowData.referred"
      @click="itemAction('finish_refer')"
      v-html="icons.stop"
      title="پایان ارجاع" 
    ></a>

    <div class="rhc-btn mx-1 rhc-btn-disabled cursor-not-allowed" v-if="rowData.referred"
      v-html="icons.refer"
      title="ارجاع" 
      disabled
    ></div>

    <div class="rhc-btn mx-1 rhc-btn-disabled cursor-not-allowed" v-if="rowData.referred"
      v-html="icons.stop"
      title="پایان ارجاع" 
      disabled
    ></div>

  </div>
</template>

<script>
import CustomActionsMixin from './../../mixins/CustomActionsMixin'

export default {
  mixins: [CustomActionsMixin]
}
</script>
