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
          <label class="font-bold">جنسیت: </label>
          <span>{{rowData.gender_title}}</span>
        </div>
      </div>
<!--      <div class="w-1/3 mb-2 px-2">-->
<!--        <div class="bg-grey-light px-3 py-1 rounded">-->
<!--          <label class="font-bold">مقطع تحصیلی: </label>-->
<!--          <span>{{rowData.grade}}</span>-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="w-1/3 mb-2 px-2">-->
<!--        <div class="bg-grey-light px-3 py-1 rounded">-->
<!--          <label class="font-bold">رشته تحصیلی: </label>-->
<!--          <span>{{rowData.field_of_study}}</span>-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="w-1/3 mb-2 px-2">-->
<!--        <div class="bg-grey-light px-3 py-1 rounded">-->
<!--          <label class="font-bold">رشته اصلی در کنکورسراسری: </label>-->
<!--          <span>{{rowData.field_title}}</span>-->
<!--        </div>-->
<!--      </div>-->
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
          <label class="font-bold">موبایل: </label>
          <span>{{rowData.mobile}}</span>
        </div>
      </div>
        <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">موبایل دوم: </label>
          <span>{{rowData.second_mobile}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">تلفن: </label>
          <span>{{rowData.phone}}</span>
        </div>
      </div>
<!--      <div class="w-1/3 mb-2 px-2">-->
<!--        <div class="bg-grey-light px-3 py-1 rounded">-->
<!--          <label class="font-bold">تلفن تماس ضروری: </label>-->
<!--          <span>{{rowData.emergency_mobile}}</span>-->
<!--        </div>-->
<!--      </div>-->
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">کد ملی: </label>
          <span>{{rowData.national_code}}</span>
        </div>
      </div>

      <!-- Refund Data -->
      <!-- <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">شناسه شبا: </label>
          <span>{{rowData.iban}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">نام و نام خانوادگی صاحب حساب: </label>
          <span>{{rowData.account_owner}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">نسبت خانوادگی: </label>
          <span>{{rowData.family_relationship}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">نام بانک: </label>
          <span>{{rowData.bank_name}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">وضعیت بازگشت هزینه: </label>
          {{rowData.refund_status_title}}
          <span v-if="rowData.refunds_count != 0">
            <svg class="w-4 fill-current align-middle mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 425.39996337890625 395.1000061035156"><path d="M404.2 13.4c-17.3-13.4-41.5-9.3-54.1 9.1L170.2 285.7 71.1 178.4C56.5 161.8 32 161 16.4 176.6.8 192.1 0 218.2 14.7 234.7c0 0 120.4 133.6 137.7 147 17.3 13.4 41.5 9.3 54.1-9.1L412.8 70.9c12.6-18.5 8.7-44.2-8.6-57.5z"/></svg>
          </span>
          <span v-else>
            <svg class="w-4 fill-current align-middle mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M437.5 386.6L306.9 256l130.6-130.6c14.1-14.1 14.1-36.8 0-50.9-14.1-14.1-36.8-14.1-50.9 0L256 205.1 125.4 74.5c-14.1-14.1-36.8-14.1-50.9 0-14.1 14.1-14.1 36.8 0 50.9L205.1 256 74.5 386.6c-14.1 14.1-14.1 36.8 0 50.9 14.1 14.1 36.8 14.1 50.9 0L256 306.9l130.6 130.6c14.1 14.1 36.8 14.1 50.9 0 14-14.1 14-36.9 0-50.9z"/></svg>
          </span>
        </div>
      </div> -->
      <!-- Refund Data -->

      <div class="w-full mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">آدرس: </label>
          <span>{{rowData.address}}</span>
        </div>
      </div>
    </div>

    <div class="w-full" v-if="rowData.purchases.length">
      <div class="w-full border-t-2 mx-2 my-4"></div>
      <div class="w-full mx-2 mb-2 font-bold">پرداخت های موفق:</div>
    </div>

    <div v-if="rowData.purchases.length" v-for="purchase, index in rowData.purchases" class="flex flex-wrap w-full mb-2">
      <div class="w-full border-t-2 mx-2 my-4" v-if="index != 0"></div>

      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">عنوان: </label>
          <span>{{purchase.title}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">مبلغ (ریال):</label>
          <span>{{formatNumber(purchase.price)}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">وضعیت پرداخت: </label>
          <span>{{purchase.payed_title}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">شناسه تراکنش: </label>
          <span>{{purchase.transaction_id}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">شناسه ارجاع: </label>
          <span>{{purchase.refrence_id}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">کد پیگیری: </label>
          <span>{{purchase.tracking_code}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 md:mb-0 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">شماره کارت: </label>
          <span class="inline-block ltr">{{purchase.card_number}}</span>
        </div>
      </div>
      <div class="w-1/3 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">تاریخ: </label>
          <span class="inline-block ltr">{{purchase.created_at_fa}}</span>
        </div>
      </div>

    </div>


    <!-- <div class="w-full" v-if="rowData.refunds.length">
      <div class="w-full border-t-2 mx-2 my-4"></div>
      <div class="w-full mx-2 mb-2 font-bold">اطلاعات بازگشت هزینه:</div>
    </div> -->

    <!-- <div v-if="rowData.refunds.length" v-for="refund, index in rowData.refunds" class="flex flex-wrap w-full mb-2">
      <div class="w-full border-t-2 mx-2 my-4" v-if="index != 0"></div>

      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">شناسه شبای دریافت کننده: </label>
          <span>{{refund.iban}}</span>
        </div>
      </div>
      <div class="w-1/3 mb-2 px-2">
        <div class="bg-grey-light px-3 py-1 rounded">
          <label class="font-bold">مبلغ (ریال):</label>
          <span>{{formatNumber(refund.price)}}</span>
        </div>
      </div>
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
