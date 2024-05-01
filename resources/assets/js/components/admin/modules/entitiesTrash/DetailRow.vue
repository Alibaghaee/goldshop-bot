<template>
  <div @click="onClick" class="flex flex-col">
    <div>
      <label class="font-bold">{{ $t('Description') }}: </label>
      <span>{{ rowData.description }}</span>
    </div>
    <div class="mt-2">
      <label class="font-bold">{{ $t('QR Code') }}: </label>
      <div v-if="rowData.uuid">
        <img :src="rowData.qrcode_base64" class="w-64 mt-1 rounded shadow">
      </div>
    </div>
    <div class="mt-2">
      <label class="font-bold">{{ $t('Bed Login link') }}: </label>
      <div v-if="rowData.uuid">
        <a :href="rowData.request_data">{{ rowData.request_data }}</a>

        <br>

        <a :href="'/entities/entities/exportLoginLink/'+rowData.id"
           class="
        mt-2 w-fit p-2 border border-blue rounded text-blue hover:text-white hover:bg-blue ">
          {{ $t('Export') }}</a>

      </div>
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
