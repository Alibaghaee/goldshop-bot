<template>
  <div @click="onClick" class="flex flex-col">
    <div>
      <label class="font-bold">محصول: </label>
      <span>{{rowData.tabiat_product_title}}</span>
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
