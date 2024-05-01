<template>
  <div @click="onClick" class="flex flex-col">
    <div>
      <img :src="rowData.icon" alt="" class="h-32">

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
