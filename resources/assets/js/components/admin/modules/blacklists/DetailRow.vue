<template>
  <div @click="onClick" class="flex flex-col">
    <div class="w-full flex flex-wrap">

      <div class="w-full md:w-1/4 pb-4 md:p-4">
        <div class="bg-white shadow rounded-lg p-6 h-full border border-grey-lighter flex flex-col flex-wrap">
          <div class="mb-3 flex justify-between">
            <label class="font-bold">اپراتور: </label>
            <a class="cursor-pointer font-bold hover:text-grey-darker inline-block no-underline text-black" :href="'/blacklists/blacklists?table_name=' + rowData.table_name">{{rowData.table_name}}</a>
          </div>
          <div class="mb-3 flex justify-between">
            <label class="font-bold">ارسال کننده: </label>
            <span class="text-black font-bold">{{rowData.sender_number}}</span>
          </div>
          <div class="mb-3 flex justify-between">
            <label class="font-bold">تعداد صفحات پیام: </label>
            <span class="text-black font-bold">{{rowData.message_part}}</span>
          </div>
          <div class="mb-3 flex justify-between">
            <label class="font-bold">شناسه گروه پیام: </label>
            <span class="text-black font-bold">{{rowData.sms_group}}</span>
          </div>
          <hr class="border-dashed border w-full mt-2 mb-6">
          <div class="">
            <label class="font-bold">متن: </label>
            <br>
            <span class="text-black font-bold whitespace-pre-line">{{ rowData.message }}</span>
          </div>
        </div>
      </div>

      <div class="w-full md:w-1/4 pb-4 md:p-4">
        <div class="bg-white shadow rounded-lg p-6 h-full border border-grey-lighter flex flex-col flex-wrap">
          <div class="mb-3 flex justify-between flex-wrap">
            <label class="font-bold">نام مدیر: </label>
            <a class="cursor-pointer font-bold hover:text-grey-darker inline-block no-underline text-black" :href="'/blacklists/blacklists?admin_id=' + rowData.admin_id">{{rowData.admin_fullname}}</a>
          </div>
          <div class="mb-3 flex justify-between flex-wrap">
            <label class="font-bold">دامنه: </label>
            <span class="text-black font-bold">{{rowData.admin_domain}}</span>
          </div>
          <hr class="border-dashed border w-full mt-2 mb-6">
          <div class="mb-3 flex justify-between flex-wrap">
            <label class="font-bold">نام کاربر: </label>
            <a class="cursor-pointer font-bold hover:text-grey-darker inline-block no-underline text-black" :href="'/blacklists/blacklists?user_id=' + rowData.user_id">{{rowData.user_fullname}}</a>
          </div>
          <div class="mb-3 flex justify-between flex-wrap">
            <label class="font-bold">موبایل کاربر: </label>
            <span class="text-black font-bold">{{rowData.user_mobile}}</span>
          </div>
          <div class="mb-3 flex justify-between flex-wrap">
            <label class="font-bold">ایمیل کاربر: </label>
            <span class="text-black font-bold">{{rowData.user_email}}</span>
          </div>
          <div class="mb-3 flex justify-between flex-wrap">
            <label class="font-bold">شناسه کاربر: </label>
            <a class="cursor-pointer font-bold hover:text-grey-darker inline-block no-underline text-black" target="_blank" :href="rowData.user_link">{{rowData.user_id}}</a>
          </div>
        </div>
      </div>

      <div class="w-full md:w-1/4 pb-4 md:p-4">
        <div class="bg-white shadow rounded-lg p-6 h-full border border-grey-lighter flex flex-col flex-wrap">
            <div class="mb-3 flex justify-between">
            <label class="font-bold">کل گیرندگان: </label>
            <span>
              <span class="text-sm text-grey ml-2" v-if="rowData.messages_count">
                ({{formatNumber(rowData.messages_count * rowData.message_part)}} صفحه)
              </span>
              <span class="text-black font-bold">{{formatNumber(rowData.messages_count)}}</span>
            </span>
          </div>
          <div class="mb-3 flex justify-between">
            <label class="font-bold">کل گیرندگان بلک لیست: </label>
            <span>
              <span class="text-sm text-grey ml-2" v-if="rowData.messages_blacklist_count">
                ({{formatNumber(rowData.messages_blacklist_count * rowData.message_part)}} صفحه)
              </span>
              <span class="text-black font-bold">{{formatNumber(rowData.messages_blacklist_count)}}</span>
            </span>
          </div>
          <div class="mb-3 flex justify-between">
            <label class="font-bold">گیرندگان بلک لیست (ایرانسل): </label>
            <span>
              <span class="text-sm text-grey ml-2" v-if="rowData.irancell_blacklists_count">
                ({{formatNumber(rowData.irancell_blacklists_count * rowData.message_part)}} صفحه)
              </span>
              <span class="text-black font-bold">{{formatNumber(rowData.irancell_blacklists_count)}}</span>
            </span>
          </div>
          <hr class="border-dashed border w-full mt-2 mb-6">
          <div class="mb-3 flex justify-between">
            <label class="font-bold">بلک لیست های ارسال شده: </label>
            <span>
              <span class="text-sm text-grey ml-2" v-if="rowData.sended_count">
                ({{formatNumber(rowData.sended_count * rowData.message_part)}} صفحه)
              </span>
              <span class="text-black font-bold">{{formatNumber(rowData.sended_count)}}</span>
            </span>
          </div>
          <span v-if="rowData.send_type">
            <div class="mb-3 flex justify-between text-center text-blue">
              <span>نحوه ارسال:</span>
              <a class="cursor-pointer font-bold hover:text-blue-light inline-block no-underline text-blue" :href="'/blacklists/blacklists?send_type=' + rowData.send_type">{{rowData.send_type}}</a>
            </div>
            <div class="mb-3 flex justify-between text-center text-blue">
              <span>ارسال توسط:</span>
              <a class="cursor-pointer font-bold hover:text-blue-light inline-block no-underline text-blue" :href="'/blacklists/blacklists?staff_id=' + rowData.staff_id">{{rowData.staff_fullname}}</a>
            </div>
          </span>
          
          <hr class="border-dashed border w-full mt-2 mb-6">
          <div class="mb-3 flex justify-between">
            <label class="font-bold">بلک لیست های قابل ارسال: </label>
            <span>
              <span class="text-sm text-grey ml-2" v-if="rowData.sendable_count">
                ({{formatNumber(rowData.sendable_count * rowData.message_part)}} صفحه)
              </span>
              <span class="text-black font-bold">{{formatNumber(rowData.sendable_count)}}</span>
            </span>
          </div>
        </div>
      </div>

      <div class="w-full md:w-1/4 pb-4 md:p-4">
        <div class="bg-white shadow rounded-lg p-6 h-full border border-grey-lighter flex flex-col flex-wrap">
          <div class="mb-3 flex justify-between">
            <label class="font-bold flex">
              قیمت بلک لیست کاربر:  
              <span class="text-sm text-green mr-3 cursor-pointer" @click="itemAction('blacklist_price_update')">به روز رسانی</span>
            </label>
            <span class="text-black font-bold">{{formatNumber(rowData.blacklist_price_for_user)}} ریال</span>
          </div>
          <div class="mb-3 flex justify-between">
            <label class="font-bold flex">
              قیمت بلک لیست مدیر:  
              <span class="text-sm text-green mr-3 cursor-pointer" @click="itemAction('blacklist_price_update')">به روز رسانی</span>
            </label>
            <span class="text-black font-bold">{{formatNumber(rowData.blacklist_price_for_admin)}} ریال</span>
          </div>
          <hr class="border-dashed border w-full mt-2 mb-6">
          <div class="mb-3 flex justify-between">
            <label class="font-bold">شارژ موجود: </label>
            <span class="text-black font-bold">{{formatNumber(rowData.user_cash)}} ریال</span>
          </div>
          <div class="mb-3 flex justify-between">
            <label class="font-bold">شارژ مورد نیاز: </label>
            <span class="text-black font-bold">{{formatNumber(rowData.needed_cash)}} ریال</span>
          </div>
          <hr class="border-dashed border w-full mt-2 mb-6">
          <div class="mb-3 flex justify-between">
            <label class="font-bold" :class="{'text-pink-dark' : rowData.lack_of_cash != 0}">میزان کمبود شارژ: </label>
            <span class="text-black font-bold" :class="{'text-pink-dark' : rowData.lack_of_cash != 0}">{{formatNumber(rowData.lack_of_cash)}} ریال</span>
          </div>

          <div class="flex flex-wrap flex-1 items-end">
            <a :href="'/blacklist_send_logs/blacklist_send_logs?blacklist_id=' + rowData.id" class="cursor-pointer font-bold hover:text-grey-dark inline-block no-underline text-grey-darker w-full">لیست خروجی ها: </a>

            <div v-for="item, key in rowData.export_files_list">
              <a :href="item.url" target="_blank" :title="'خروجی ' + item.date_fa" class="rhc-btn rhc-btn-sm rhc-action-btn opacity-50" :class="{ 'opacity-100' : rowData.export_files_list.length - 1 == key  }">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 384" class="fill-current w-4 h-4"><path d="M344 0H40C17.909 0 0 17.908 0 40v304c0 22.092 17.909 40 40 40h304c22.092 0 40-17.908 40-40V40c0-22.092-17.908-40-40-40zM240 304H80v-48h160v48zm64-88H80v-48h224v48zm0-88H80V80h224v48z"></path></svg>
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import accounting from 'accounting'
import CustomActionsMixin from './../../mixins/CustomActionsMixin'

export default {
  mixins: [CustomActionsMixin],

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
