 class="inline-block ltr"<template>
  <div @click="onClick" class="flex flex-col">
    <div>
      <label class="font-bold">نوع: </label>
      <span>{{rowData.type}}</span>
    </div>
    <div>
      <label class="font-bold">گروه: </label>
      <span>{{rowData.group}}</span>
    </div>
    <div>
      <label class="font-bold">آدرس: </label>
      <span>{{rowData.address}}</span>
    </div>
    <div>
      <label class="font-bold">کد پستی: </label>
      <span>{{rowData.postal_code}}</span>
    </div>
    <div>
      <label class="font-bold">ایمیل: </label>
      <span>{{rowData.email}}</span>
    </div>
    <div>
      <label class="font-bold">تلفن: </label>
      <span>{{rowData.phone}}</span>
    </div>
    <div>
      <label class="font-bold">فکس: </label>
      <span>{{rowData.fax}}</span>
    </div>
    <div>
      <label class="font-bold">سایت: </label>
      <span>{{rowData.website}}</span>
    </div>
    <div>
      <label class="font-bold">نحوه آشنایی: </label>
      <span>{{rowData.how_know_id}}</span>
    </div>
    <div>
      <label class="font-bold">نام شرکت: </label>
      <span>{{rowData.company_name}}</span>
    </div>
    <div>
      <label class="font-bold">کد اقتصادی: </label>
      <span>{{rowData.economic_code}}</span>
    </div>
    <div>
      <label class="font-bold">شناسه ملی شرکت: </label>
      <span>{{rowData.company_national_code}}</span>
    </div>
    <div>
      <label class="font-bold">شناسه ثبت: </label>
      <span>{{rowData.register_id}}</span>
    </div>
    <div>
      <label class="font-bold">نام: </label>
      <span>{{rowData.name}}</span>
    </div>
    <div>
      <label class="font-bold">نام خانوادگی: </label>
      <span>{{rowData.family}}</span>
    </div>
    <div>
      <label class="font-bold">موبایل: </label>
      <span>{{rowData.mobile}}</span>
    </div>
    <div>
      <label class="font-bold">نام پدر: </label>
      <span>{{rowData.father_name}}</span>
    </div>
    <div>
      <label class="font-bold">کد ملی: </label>
      <span>{{rowData.national_code}}</span>
    </div>
    <div>
      <label class="font-bold">شماره شناسنامه: </label>
      <span>{{rowData.id_number}}</span>
    </div>
    <div>
      <label class="font-bold">محل تولد: </label>
      <span>{{rowData.place}}</span>
    </div>
    <div>
      <label class="font-bold">جنسیت: </label>
      <span>{{rowData.sex}}</span>
    </div>
    <div>
      <label class="font-bold">تاریخ تولد: </label>
      <span class="inline-block ltr">{{rowData.birth_date}}</span>
    </div>
    <div>
      <label class="font-bold">تاریخ ایجاد مشتری: </label>
      <span class="inline-block ltr">{{rowData.created_at}}</span>
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
