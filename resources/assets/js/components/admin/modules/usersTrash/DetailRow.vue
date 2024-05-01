<template>
  <div @click="onClick" class="flex flex-col">
    <div class="">
      <label>نام: </label>
      <span>{{rowData.name}}</span>
    </div>
    <div class="">
      <label>ایمیل: </label>
      <span>{{rowData.email}}</span>
    </div>
    <div class="">
      <label>موبایل: </label>
      <span>{{rowData.mobile}}</span>
    </div>
    <div class="">
      <label>نام کاربری: </label>
      <span>{{rowData.username}}</span>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    rowData: {
      type: Object,
      required: true
    },
    rowIndex: {
      type: Number
    }
  },
  methods: {
    onClick (event) {
      console.log('my-detail-row: on-click', event.target)
    }
  },
}
</script>
