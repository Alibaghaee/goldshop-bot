<template>
  <div class="flex justify-center -mx-1">

    <a class="rhc-btn rhc-action-btn leading-normal px-4"
      :href="rowData.user.edit_uri"
      title="نمایش اطلاعات سفارش دهنده" 
      target="_blank" 
    >نمایش اطلاعات سفارش دهنده</a>

  </div>
</template>

<script>
import CustomActionsMixin from './../../mixins/CustomActionsMixin'

export default {
  mixins: [CustomActionsMixin]
}
</script>
