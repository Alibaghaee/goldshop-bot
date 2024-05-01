<template>
  <div class="flex justify-center -mx-1">

    <a class="rhc-btn rhc-action-btn"
      :href="rowData.show_uri"
      v-html="icons.chart"
      title="نمایش نمودار" 
      target="_blank"
    ></a>

  </div>
</template>

<script>
import CustomActionsMixin from "./../../mixins/CustomActionsMixin";

export default {
    mixins: [CustomActionsMixin]
};
</script>
