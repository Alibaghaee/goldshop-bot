<template>
  <div @click="onClick" class="flex flex-col">
    <div class="font-bold text-grey-darkest">اطلاعات برنده:</div>
    <div>
      <label class="font-bold">موبایل: </label>
      <span>{{  rowData.winner_data.mobile  }}</span>
    </div>
    <div>
      <label class="font-bold">کد قرعه کشی: </label>
      <span>{{  rowData.winner_data.code  }}</span>
    </div>
    <div>
      <label class="font-bold">ردیف: </label>
      <span>{{  rowData.winner_data.total_id  }}</span>
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
    onClick(event) {
      console.log('my-detail-row: on-click', event.target)
    },
  },
}
</script>
