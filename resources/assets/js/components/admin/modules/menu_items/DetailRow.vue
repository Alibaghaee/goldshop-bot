<template>
  <div @click="onClick" class="flex flex-col">
    <div>
      <label class="font-bold">عنوان: </label>
      <span>{{rowData.title}}</span>
    </div>
    <div style="direction: ltr;">
      <span><a :href="rowData.link" class="text-blue">{{rowData.link}}</a></span>
      <label class="font-bold"> :پیوند </label>
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
