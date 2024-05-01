<template>
  <div class="flex justify-center -mx-1">

    <a class="rhc-btn rhc-action-btn"
      :href="rowData.items_uri"
      v-html="icons.items"
      title="لیست زیر گروه ها" 
    ></a>

    <a class="rhc-btn rhc-action-btn"
      :href="rowData.order_uri"
      v-html="icons.order"
      title="مرتب سازی زیر گروه ها" 
    ></a>

  </div>
</template>

<script>
import CustomActionsMixin from './../../mixins/CustomActionsMixin'

export default {
  mixins: [CustomActionsMixin]
}
</script>
