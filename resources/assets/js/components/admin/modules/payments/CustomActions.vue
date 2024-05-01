<template>
  <div class="flex justify-center -mx-1">

    <a class="rhc-btn rhc-action-btn leading-normal px-4 flex-none"
      :href="rowData.user.edit_uri"
      title="ویرایش کاربر" 
      target="_blank" 
    >ویرایش کاربر</a>

  </div>
</template>

<script>
import CustomActionsMixin from './../../mixins/CustomActionsMixin'

export default {
  mixins: [CustomActionsMixin]
}
</script>
