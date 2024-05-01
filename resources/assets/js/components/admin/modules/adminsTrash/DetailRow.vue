<template>
  <div @click="onClick" class="flex flex-col">
    <div class="">
      <label>{{ $t('Name') }}: </label>
      <span>{{rowData.name}}</span>
    </div>
    <div class="">
      <label>{{ $t('Email') }}: </label>
      <span>{{rowData.email}}</span>
    </div>
    <div class="">
      <label>{{ $t('Mobile') }}: </label>
      <span>{{rowData.mobile}}</span>
    </div>
    <div class="">
      <label>{{ $t('Username') }}: </label>
      <span>{{rowData.username}}</span>
    </div>
    <div class="mt-2">
      <label class="font-bold">QR Code: </label>
      <div v-if="rowData.uuid">
        <img :src="rowData.qrcode_base64" class="w-64 mt-1 rounded shadow">
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
    onClick (event) {
      console.log('my-detail-row: on-click', event.target)
    }
  },
}
</script>
