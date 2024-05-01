<template>
  <div class="flex justify-center -mx-1">

    <a class="rhc-btn rhc-action-btn" 
    :href="rowData.get_file_uri" 
    v-html="icons.document" 
    title="دانلود خروجی" 
    target="_blank"
    v-if="rowData.file_status == 2"
    >
    </a>

    <a class="rhc-btn rhc-action-btn rhc-btn-disabled" 
    href="#" 
    v-html="icons.document" 
    title="دانلود خروجی" 
    target="_blank"
    v-if="rowData.file_status != 2"
    >
    </a>

  </div>
</template>

<script>
import CustomActionsMixin from "./../../mixins/CustomActionsMixin";

export default {
  mixins: [CustomActionsMixin]
};
</script>
