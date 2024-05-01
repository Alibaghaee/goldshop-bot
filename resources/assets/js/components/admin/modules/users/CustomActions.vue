<template>
  <div class="flex justify-center -mx-1">

    <a class="rhc-btn rhc-action-btn leading-normal px-4"
      :href="rowData.purchases_list_uri"
      title="لیست پرداخت ها (تراکنش ها)" 
      target="_blank" 
    >پرداخت ها</a>

  </div>
</template>

<script>
import CustomActionsMixin from './../../mixins/CustomActionsMixin'

export default {
  mixins: [CustomActionsMixin]
}
</script>
