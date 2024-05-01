<template>
  <div @click="onClick" class="flex flex-col">
    <div>
      <label class="font-bold">متن نامه: </label> <br>
      <span v-html="rowData.description"></span>
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
  },
}
</script>
