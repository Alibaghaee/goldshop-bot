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
      <label>تاریخ تولد: </label>
      <span>{{rowData.birthdate}}</span>
    </div>
    <div class="">
      <label>جنسیت: </label>
      <span v-html="genderLabel(rowData.gender)"></span>
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
    },
    genderLabel (value) {
      return value === 'M'
        ? '<span class="ui teal label"><i class="large man icon"></i>Male</span>'
        : '<span class="ui pink label"><i class="large woman icon"></i>Female</span>'
    }
  },
}
</script>
