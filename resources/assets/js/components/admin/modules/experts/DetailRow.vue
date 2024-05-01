<template>
  <div @click="onClick" class="flex flex-col">
    <div>
      <label class="font-bold">نام: </label>
      <span>{{rowData.name}}</span>
    </div>
    <div>
      <label class="font-bold">نام خانوادگی: </label>
      <span>{{rowData.family}}</span>
    </div>
    <div>
      <label class="font-bold">موبایل: </label>
      <span>{{rowData.mobile}}</span>
    </div>
    <div>
      <label class="font-bold">تلفن: </label>
      <span>{{rowData.phone}}</span>
    </div>
    <div>
      <label class="font-bold">آدرس: </label>
      <span>{{rowData.address}}</span>
    </div>
    <div>
      <label class="font-bold">زمان هر نوبت (دقیقه): </label>
      <span>{{rowData.visit_duration}}</span>
    </div>
    <div>
      <label class="font-bold">هزینه ویزیت (تومان): </label>
      <span>{{ formatNumber(rowData.visit_fee) }}</span>
    </div>
    <div>
      <label class="font-bold">سهم متخصص (درصد): </label>
      <span>{{rowData.expert_contribution}}</span>
    </div>
    <div>
      <label class="font-bold">توضیحات: </label>
      <span>{{rowData.description}}</span>
    </div>
    <div>
      <label class="font-bold">بخش: </label>
      <span>{{rowData.department_name}}</span>
    </div>


  </div>
</template>

<script>
import accounting from 'accounting';

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
    formatNumber (value) {
      return accounting.formatNumber(value)
    },
  },
}
</script>
