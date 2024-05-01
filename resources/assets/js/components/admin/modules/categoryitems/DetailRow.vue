<template>
  <div @click="onClick" class="flex flex-col">
    <div>
      <label class="font-bold">توضیحات: </label>
      <span>{{rowData.description}}</span>
    </div>
    <!-- <div>
      <label class="font-bold">نشانی: </label>
      <span><a :href="'/fa/pages/'+rowData.category_id+'/'+rowData.id">pages/{{rowData.category_id}}/{{rowData.id}}</a></span>
    </div> -->
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
