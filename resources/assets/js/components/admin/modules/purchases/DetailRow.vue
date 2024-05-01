<template>
  <div @click="onClick" class="flex flex-wrap -mx-2">
    <div class="flex flex-wrap w-full">
  
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">عنوان: </label>
          <span>{{rowData.title}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">توضیحات: </label>
          <span>{{rowData.description}}</span>
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
          <label class="font-bold">وضعیت تراکنش: </label>
          <span>{{rowData.payed_title}}</span>
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
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">کد پیگیری: </label>
          <span>{{rowData.tracking_code}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 md:mb-0 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">شماره کارت: </label>
          <span class="inline-block ltr">{{rowData.card_number}}</span>
        </div>
      </div>
      <div class="w-1/3 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">تاریخ: </label>
          <span class="inline-block ltr">{{rowData.created_at_fa}}</span>
        </div>
      </div>
      

    </div>

    <div v-if="rowData.user" class="flex flex-wrap w-full">

      <div class="w-full border-t-2 mx-2 mb-3 mt-1"></div>

      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">نام: </label>
          <span>{{rowData.user.name}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">نام خانوادگی: </label>
          <span>{{rowData.user.family}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">جنسیت: </label>
          <span>{{rowData.user.gender_title}}</span>
        </div>
      </div>
      <!-- <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">مقطع تحصیلی: </label>
          <span>{{rowData.user.grade}}</span>
        </div>
      </div> -->
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">رشته تحصیلی: </label>
          <span>{{rowData.user.field_of_study}}</span>
        </div>
      </div>
      <!-- <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">رشته اصلی در کنکورسراسری: </label>
          <span>{{rowData.user.field_title}}</span>
        </div>
      </div> -->
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">استان: </label>
          <span>{{rowData.user.province_title}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">شهر: </label>
          <span>{{rowData.user.city_title}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">موبایل: </label>
          <span>{{rowData.user.mobile}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">تلفن: </label>
          <span>{{rowData.user.phone}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">تلفن تماس ضروری: </label>
          <span>{{rowData.user.emergency_mobile}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">کد ملی: </label>
          <span>{{rowData.user.national_code}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">کد پستی: </label>
          <span>{{rowData.user.postal_code}}</span>
        </div>
      </div>
      <div class="w-2/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">آدرس: </label>
          <span>{{rowData.user.address}}</span>
        </div>
      </div>
    </div>

    <!-- <div v-if="rowData.details" class="flex flex-wrap w-full">
      <div class="font-semibold px-2 text-grey-dark text-xl mt-2">محصولات سبد:</div>
      <template v-for="detail in rowData.details">
        <div class="w-full border-t-2 mx-2 mb-3 mt-1"></div>
        <div class="w-2/5 mb-2 px-2">
          <div class="bg-grey-light px-3 py-1 rounded">
            <label class="font-bold">عنوان: </label>
            <span>{{detail.title}}</span>
          </div>
        </div>
        <div class="w-1/5 mb-2 px-2">
          <div class="bg-grey-light px-3 py-1 rounded">
            <label class="font-bold">قیمت (ریال): </label>
            <span>{{formatNumber(detail.price)}}</span>
          </div>
        </div>
        <div class="w-1/5 mb-2 px-2">
          <div class="bg-grey-light px-3 py-1 rounded">
            <label class="font-bold">تعداد: </label>
            <span>{{detail.count}}</span>
          </div>
        </div>
        <div class="w-1/5 mb-2 px-2">
          <div class="bg-grey-light px-3 py-1 rounded">
            <label class="font-bold">کد: </label>
            <span>{{detail.code}}</span>
          </div>
        </div>
      </template>
    </div> -->

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
