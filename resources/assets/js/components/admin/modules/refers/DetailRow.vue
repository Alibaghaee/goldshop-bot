<template>
  <div @click="onClick" class="flex">
    <div class="w-full md:w-1/2">
      <div>
        <label class="font-bold">از: </label>
        <span>{{rowData.from_fullname}}</span>
      </div>
      <div>
        <label class="font-bold">به: </label>
        <span>{{rowData.to_fullname}}</span>
      </div>
      <div>
        <label class="font-bold">توضیح: </label>
        <span>{{rowData.description}}</span>
      </div>
      <div>
        <label class="font-bold">تاریخ ارجاع: </label>
        <span>{{rowData.created_at}}</span>
      </div>
      <div v-if="rowData.file">
        <label class="font-bold">فایل: </label>
        <span><a :href="rowData.file" dwonload target="_blank">دانلود</a></span>
      </div>
    </div>

    <div class="w-full md:w-1/2 p-4 rounded bg-grey-light">
      <div class="font-bold mb-2">
        اطلاعات فعالیت محوله 
        <span class="font-medium text-xs opacity-75">(شناسه {{rowData.task.id}}#) </span>:
      </div>
      <div class="flex flex-row flex-wrap justify-between">
        <div>
          <label class="font-bold">ایجاد کننده:</label>
          <span>{{rowData.task.creator_fullname}}</span>
        </div>
        <div>
          <label class="font-bold">دریافت کننده:</label>
          <span>{{rowData.task.receiver_fullname}}</span>
        </div>
        <div>
          <label class="font-bold">وظیفه:</label>
          <span>{{rowData.task.description}}</span>
        </div>
        <div>
          <label class="font-bold">تاریخ:</label>
          <span class="inline-block ltr">{{rowData.task.start_date}}</span>
        </div>
        <div>
          <label class="font-bold">مهلت:</label>
          <span class="inline-block ltr">{{rowData.task.deadline}}</span>
        </div>
        <div v-if="rowData.task.report_status">
          <label class="font-bold">وضعیت گزارش:</label>
          <span>{{rowData.task.report_status}}</span>
        </div>
        <div v-if="rowData.task.reported_at">
          <label class="font-bold">زمان گزارش:</label>
          <span class="inline-block ltr">{{rowData.task.reported_at}}</span>
        </div>
         <div v-if="rowData.task.report_description">
          <label class="font-bold">گزارش فعالیت: </label>
          <span>{{rowData.task.report_description}}</span>
        </div>
        <div v-if="rowData.task.status">
          <label class="font-bold">وضعیت انجام کار:</label>
          <span>{{rowData.task.status}}</span>
        </div> 
      </div>
      <div 
        v-for="refer in rowData.task.refers" 
        class="border-grey border-t mt-4 pt-4" 
        :class="{'text-blue': rowData.id == refer.id}"
      >
        <div class="flex justify-between mb-2">
          <div class="flex-auto font-bold">
            ارجاع:
            <span class="font-medium text-xs opacity-75">(شناسه {{refer.id}}#) </span>
          </div>
          <div class="font-medium text-xs opacity-75">
            <label>تاریخ ارجاع:</label>
            <span class="inline-block ltr">{{refer.created_at}}</span>
          </div>
        </div>
        <div class="flex flex-row flex-wrap justify-between">
          <div>
            <label class="font-bold">از:</label>
            <span>{{refer.from_fullname}}</span>
          </div>
          <div>
            <label class="font-bold">به:</label>
            <span>{{refer.to_fullname}}</span>
          </div>
          <div>
            <label class="font-bold">توضیح:</label>
            <span>{{refer.description}}</span>
          </div>
          <div v-if="refer.file">
            <label class="font-bold">فایل:</label>
            <span><a :href="refer.file" dwonload target="_blank">دانلود</a></span>
          </div>
        </div>
        
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
