<template>
  <div @click="onClick" class="flex flex-wrap">
    <div class="w-full md:w-1/2">
      <label class="font-bold">Causer: </label>
      <pre>{{rowData.causer}}</pre>
    </div>
    <div class="w-full md:w-1/2">
      <label class="font-bold">Properties: </label>
      <pre>{{rowData.properties}}</pre>
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
