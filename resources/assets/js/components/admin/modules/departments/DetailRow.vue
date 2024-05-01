<template>
  <div @click="onClick" class="flex flex-col">
    <div>
      <label class="font-bold">عنوان: </label>
      <span>{{rowData.title}}</span>
    </div>
    <div>
      <label class="font-bold">توضیحات: </label>
      <span>{{rowData.description}}</span>
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
