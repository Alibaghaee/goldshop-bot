<template>
  <div @click="onClick" class="flex flex-col">

    <div>
      <label class="font-bold">{{ $t('Description') }}: </label>
      <span>{{rowData.description}}</span>
    </div>

    <br>

    <div class="font-bold">{{ $t('Requests') }}:</div>

    <div>
      <div v-for="item in rowData.items" class="flex items-center">
        <svg class="w-4 h-4 fill-current mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 384"><path d="M317.7 161.9c0-97.6-52.5-130.8-101.6-138.2 0-.5.1-1 .1-1.6C216.2 9.8 205.3 0 192 0c-13.3 0-23.8 9.8-23.8 22.1 0 .6 0 1.1.1 1.6-49.2 7.5-102 40.8-102 138.4 0 113.8-28.3 126-66.3 158h384c-37.8-32.1-66.3-44.4-66.3-158.2zM192.2 384c26.8 0 48.8-19.9 51.7-43H140.5c2.8 23.1 24.9 43 51.7 43z"/></svg>
        <span class="font-bold">{{item.status_title}}</span>: {{ item.item_title }}
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
    },
  },
}
</script>
