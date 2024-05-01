<template>
  <div @click="onClick" class="flex flex-wrap -mx-2">
    <div class="flex flex-wrap w-full">

      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">نام: </label>
          <span>{{rowData.name}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">نام خانوادگی: </label>
          <span>{{rowData.family}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">کد ملی: </label>
          <span>{{rowData.national_code}}</span>
        </div>
      </div>
            <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">موبایل: </label>
          <span>{{rowData.mobile}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">تلفن: </label>
          <span>{{rowData.phone}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">تلفن تماس ضروری: </label>
          <span>{{rowData.emergency_mobile}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">مقطع تحصیلی: </label>
          <span>{{rowData.grade}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">رشته تحصیلی: </label>
          <span>{{rowData.field_of_study}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">استان: </label>
          <span>{{rowData.province_title}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">شهر: </label>
          <span>{{rowData.city_title}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">جنسیت: </label>
          <span>{{rowData.gender_title}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">موضوع پرداخت: </label>
          <span>{{rowData.payment_subject}}</span>
        </div>
      </div>
      <div class="w-1/3 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">تاریخ: </label>
          <span class="inline-block ltr">{{rowData.created_at_fa}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">مبلغ (ریال):</label>
          <span>{{formatNumber(rowData.price)}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">کد پیگیری: </label>
          <span>{{rowData.tracking_code}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">شناسه تراکنش: </label>
          <span>{{rowData.transaction_id}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">شناسه ارجاع: </label>
          <span>{{rowData.refrence_id}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 md:mb-0 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">شماره کارت: </label>
          <span class="inline-block ltr">{{rowData.card_number}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">شرح پرداخت: </label>
          <span>{{rowData.description}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">وضعیت پرداخت: </label>
          <span>{{rowData.payed_title}}</span>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import accounting from 'accounting'

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
    formatNumber (value) {
      return accounting.formatNumber(value, 0)
    },
  },
}
</script>
