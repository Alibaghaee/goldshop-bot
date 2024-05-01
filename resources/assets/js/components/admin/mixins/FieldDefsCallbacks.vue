<script>
export default {
  methods: {
      lockLabel (value) {
        return value == true
          ? `
          <div class="fill-current w-6 h-6 text-green m-auto" title="قابل حذف">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M86.4 480h339.2c12.3 0 22.4-9.9 22.4-22.1V246c0-12.2-10-22-22.4-22H161v-30.9c0-27.3 9.9-61.1 28.1-80.3v-.3C206.7 93.9 231 83 255.9 83h.2c24.9 0 49.2 10.9 66.8 29.5V112.8c11.3 11.9 19.4 29.3 24 47.3h53.4c-5.9-31.3-19.7-61.8-39.2-82.4-26.2-27.8-63.7-45.7-105-45.7h-.1-.1c-41.3 0-79 17.9-105.3 45.6C124.2 105.4 108 151.5 108 193v31H86.4C74 224 64 233.9 64 246v211.9c0 12.2 10 22.1 22.4 22.1z"/></svg>
          </div>
          `
          : `
          <div class="fill-current w-6 h-6 text-pink m-auto" title="غیر قابل حذف">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M86.4 480h339.2c12.3 0 22.4-9.9 22.4-22.1V246c0-12.2-10-22-22.4-22H404v-30.9c0-41.5-16.2-87.6-42.6-115.4-26.3-27.8-64-45.7-105.3-45.7h-.1-.1c-41.3 0-79 17.9-105.3 45.6C124.2 105.4 108 151.5 108 193v31H86.4C74 224 64 233.9 64 246v211.9c0 12.2 10 22.1 22.4 22.1zM161 193.1c0-27.3 9.9-61.1 28.1-80.3v-.3C206.7 93.9 231 83 255.9 83h.2c24.9 0 49.2 10.9 66.8 29.5v.2l-.1.1c18.3 19.2 28.1 53 28.1 80.3V224H161v-30.9z"/></svg>
          </div>
          `
      },

      activeLabel (value) {
        return value == true
          ? `
          <div class="fill-current w-6 h-6 text-green m-auto" title="فعال">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 256"><path d="M224 0C142.1 0 78.3 48.8 0 128c67.4 67.7 124 128 224 128 99.9 0 173.4-76.4 224-126.6C396.2 70.6 322.8 0 224 0zm0 219.3c-49.4 0-89.6-41-89.6-91.3 0-50.4 40.2-91.3 89.6-91.3s89.6 41 89.6 91.3c0 50.4-40.2 91.3-89.6 91.3z"/><path d="M224 96c0-7.9 2.9-15.1 7.6-20.7-2.5-.4-5-.6-7.6-.6-28.8 0-52.3 23.9-52.3 53.3s23.5 53.3 52.3 53.3 52.3-23.9 52.3-53.3c0-2.3-.2-4.6-.4-6.9-5.5 4.3-12.3 6.9-19.8 6.9-17.8 0-32.1-14.3-32.1-32z"/></svg>
          </div>
          `
          : `
          <div class="fill-current w-6 h-6 text-pink m-auto" title="غیر فعال">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 384"><path d="M344.4 94.3L416 22.6 393.4 0l-77.6 77.6C288 63.7 257.5 55 224 55 142.1 55 78.3 107.2 0 192c34.8 37.4 66.8 72.7 103.3 98.1L32 361.4 54.6 384l76.9-76.9c27 13.7 57 21.9 92.5 21.9 99.9 0 173.4-81.8 224-135.5-28-34.1-62.4-71.8-103.6-99.2zm-210 97.7c0-50.4 40.2-91.3 89.6-91.3 19.3 0 37.2 6.2 51.8 16.9l-50.7 50.7c-.7-2.6-1.1-5.4-1.1-8.3 0-7.9 2.9-15.1 7.6-20.7-2.5-.4-5-.6-7.6-.6-28.8 0-52.3 23.9-52.3 53.3 0 8.6 2 16.8 5.6 24L150 243.4c-9.8-14.7-15.6-32.4-15.6-51.4zm89.6 91.3c-19.3 0-37.2-6.2-51.8-16.9l27.4-27.4c7.3 4 15.6 6.2 24.4 6.2 28.8 0 52.3-23.9 52.3-53.3 0-2.3-.2-4.6-.4-6.9-5.5 4.3-12.3 6.9-19.8 6.9-2.9 0-5.6-.4-8.3-1.1l50.3-50.3c9.8 14.6 15.6 32.3 15.6 51.4-.1 50.5-40.3 91.4-89.7 91.4z"/></svg>
          </div>
          `
      },
      boolean (value) {
        return value == true
          ? `
          <div class="fill-current w-6 h-6 text-green m-auto" title="بله">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 448"><path d="M224 0C100.3 0 0 100.3 0 224s100.3 224 224 224 224-100.3 224-224S347.7 0 224 0zm114.9 149.1L199.8 327.6c-1.1 1.1-2.9 3.5-5.1 3.5-2.3 0-3.8-1.6-5.1-2.9-1.3-1.3-78.9-75.9-78.9-75.9l-1.5-1.5c-.6-.9-1.1-2-1.1-3.2 0-1.2.5-2.3 1.1-3.2.4-.4.7-.7 1.1-1.2 7.7-8.1 23.3-24.5 24.3-25.5 1.3-1.3 2.4-3 4.8-3 2.5 0 4.1 2.1 5.3 3.3 1.2 1.2 45 43.3 45 43.3l111.3-143c1-.8 2.2-1.4 3.5-1.4 1.3 0 2.5.5 3.5 1.3l30.6 24.1c.8 1 1.3 2.2 1.3 3.5.1 1.3-.4 2.4-1 3.3z"/></svg>
          </div>
          `
          : `
          <div class="fill-current w-6 h-6 text-grey-light m-auto" title="خیر">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 448"><path d="M224 0C100.3 0 0 100.3 0 224s100.3 224 224 224 224-100.3 224-224S347.7 0 224 0zm114.9 149.1L199.8 327.6c-1.1 1.1-2.9 3.5-5.1 3.5-2.3 0-3.8-1.6-5.1-2.9-1.3-1.3-78.9-75.9-78.9-75.9l-1.5-1.5c-.6-.9-1.1-2-1.1-3.2 0-1.2.5-2.3 1.1-3.2.4-.4.7-.7 1.1-1.2 7.7-8.1 23.3-24.5 24.3-25.5 1.3-1.3 2.4-3 4.8-3 2.5 0 4.1 2.1 5.3 3.3 1.2 1.2 45 43.3 45 43.3l111.3-143c1-.8 2.2-1.4 3.5-1.4 1.3 0 2.5.5 3.5 1.3l30.6 24.1c.8 1 1.3 2.2 1.3 3.5.1 1.3-.4 2.4-1 3.3z"/></svg>
          </div>
          `
      },
      deleted (value) {
        return value == true
          ? `
          <div class="fill-current w-6 h-6 text-pink m-auto" title="حذف شده">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 448"><path d="M224 0C100.3 0 0 100.3 0 224s100.3 224 224 224 224-100.3 224-224S347.7 0 224 0zm108.3 299.5c1.5 1.5 2.3 3.5 2.3 5.6 0 2.1-.8 4.2-2.3 5.6l-21.6 21.7c-1.6 1.6-3.6 2.3-5.6 2.3-2 0-4.1-.8-5.6-2.3L224 256.8l-75.4 75.7c-1.5 1.6-3.6 2.3-5.6 2.3-2 0-4.1-.8-5.6-2.3l-21.6-21.7c-1.5-1.5-2.3-3.5-2.3-5.6 0-2.1.8-4.2 2.3-5.6l75.7-76-75.9-75c-3.1-3.1-3.1-8.2 0-11.3l21.6-21.7c1.5-1.5 3.5-2.3 5.6-2.3 2.1 0 4.1.8 5.6 2.3l75.7 74.7 75.7-74.7c1.5-1.5 3.5-2.3 5.6-2.3 2.1 0 4.1.8 5.6 2.3l21.6 21.7c3.1 3.1 3.1 8.2 0 11.3l-75.9 75 75.6 75.9z"/></svg>
          </div>
          `
          : `
          <div class="fill-current w-6 h-6 text-grey-light m-auto" title="حذف نشده">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 448"><path d="M224 0C100.3 0 0 100.3 0 224s100.3 224 224 224 224-100.3 224-224S347.7 0 224 0zm108.3 299.5c1.5 1.5 2.3 3.5 2.3 5.6 0 2.1-.8 4.2-2.3 5.6l-21.6 21.7c-1.6 1.6-3.6 2.3-5.6 2.3-2 0-4.1-.8-5.6-2.3L224 256.8l-75.4 75.7c-1.5 1.6-3.6 2.3-5.6 2.3-2 0-4.1-.8-5.6-2.3l-21.6-21.7c-1.5-1.5-2.3-3.5-2.3-5.6 0-2.1.8-4.2 2.3-5.6l75.7-76-75.9-75c-3.1-3.1-3.1-8.2 0-11.3l21.6-21.7c1.5-1.5 3.5-2.3 5.6-2.3 2.1 0 4.1.8 5.6 2.3l75.7 74.7 75.7-74.7c1.5-1.5 3.5-2.3 5.6-2.3 2.1 0 4.1.8 5.6 2.3l21.6 21.7c3.1 3.1 3.1 8.2 0 11.3l-75.9 75 75.6 75.9z"/></svg>
          </div>
          `
      },
      isOverMaxUses (value) {
        return value == false
          ? `
          <div class="fill-current w-6 h-6 text-green m-auto" title="بله">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 416 416"><path d="M208 416c114.9 0 208-93.1 208-208S322.9 0 208 0 0 93.1 0 208s93.1 208 208 208z"/></svg>
          </div>
          `
          : `
          <div class="fill-current w-6 h-6 text-pink m-auto" title="خیر">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 416 416"><path d="M208 416c114.9 0 208-93.1 208-208S322.9 0 208 0 0 93.1 0 208s93.1 208 208 208z"/></svg>
          </div>
          `
      },
      private (value) {
        return value == true
          ? `
          <div class="fill-current w-6 h-6 text-pink m-auto" title="خصوصی">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 384"><path d="M344.4 94.3L416 22.6 393.4 0l-77.6 77.6C288 63.7 257.5 55 224 55 142.1 55 78.3 107.2 0 192c34.8 37.4 66.8 72.7 103.3 98.1L32 361.4 54.6 384l76.9-76.9c27 13.7 57 21.9 92.5 21.9 99.9 0 173.4-81.8 224-135.5-28-34.1-62.4-71.8-103.6-99.2zm-210 97.7c0-50.4 40.2-91.3 89.6-91.3 19.3 0 37.2 6.2 51.8 16.9l-50.7 50.7c-.7-2.6-1.1-5.4-1.1-8.3 0-7.9 2.9-15.1 7.6-20.7-2.5-.4-5-.6-7.6-.6-28.8 0-52.3 23.9-52.3 53.3 0 8.6 2 16.8 5.6 24L150 243.4c-9.8-14.7-15.6-32.4-15.6-51.4zm89.6 91.3c-19.3 0-37.2-6.2-51.8-16.9l27.4-27.4c7.3 4 15.6 6.2 24.4 6.2 28.8 0 52.3-23.9 52.3-53.3 0-2.3-.2-4.6-.4-6.9-5.5 4.3-12.3 6.9-19.8 6.9-2.9 0-5.6-.4-8.3-1.1l50.3-50.3c9.8 14.6 15.6 32.3 15.6 51.4-.1 50.5-40.3 91.4-89.7 91.4z"/></svg>
          </div>
          `
          : `
          <div class="fill-current w-6 h-6 text-green m-auto" title="عمومی">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 256"><path d="M224 0C142.1 0 78.3 48.8 0 128c67.4 67.7 124 128 224 128 99.9 0 173.4-76.4 224-126.6C396.2 70.6 322.8 0 224 0zm0 219.3c-49.4 0-89.6-41-89.6-91.3 0-50.4 40.2-91.3 89.6-91.3s89.6 41 89.6 91.3c0 50.4-40.2 91.3-89.6 91.3z"/><path d="M224 96c0-7.9 2.9-15.1 7.6-20.7-2.5-.4-5-.6-7.6-.6-28.8 0-52.3 23.9-52.3 53.3s23.5 53.3 52.3 53.3 52.3-23.9 52.3-53.3c0-2.3-.2-4.6-.4-6.9-5.5 4.3-12.3 6.9-19.8 6.9-17.8 0-32.1-14.3-32.1-32z"/></svg>
          </div>
          `
      },
      link (value){
        if (value) {
          return `
            <a href="${value}" title="${value}" target="_blank">
              <svg class="fill-current h-6 w-6 text-blue hover:text-blue-light align-middle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 192"><path d="M192.5 48h-.5.5zm112-48H256s26 17 31.6 48h16.9c17.6 0 31.5 13.9 31.5 31.5v32c0 17.6-13.9 32.5-31.5 32.5h-112c-17.6 0-32.5-14.9-32.5-32.5V80h-48v31.5c0 11.5 2.5 22.5 6.9 32.5 12.6 28.2 40.9 48 73.6 48h112c44.2 0 79.5-36.3 79.5-80.5v-32C384 35.3 348.7 0 304.5 0z"/><path d="M265.6 48c-12.1-28.3-40.1-48-73.1-48h-112C36.3 0 0 35.3 0 79.5v32C0 155.7 36.3 192 80.5 192H128s-25.8-17-32.1-48H80.5C62.9 144 48 129.1 48 111.5v-32C48 61.9 62.9 48 80.5 48h112c17.6 0 31.5 13.9 31.5 31.5V112h48V79.5c0-11.2-2.3-21.9-6.4-31.5z"/></svg>
            </a>
          `
        }else{
          return `
            <svg class="fill-current h-6 w-6 text-grey-light align-middle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 192"><path d="M192.5 48h-.5.5zm112-48H256s26 17 31.6 48h16.9c17.6 0 31.5 13.9 31.5 31.5v32c0 17.6-13.9 32.5-31.5 32.5h-112c-17.6 0-32.5-14.9-32.5-32.5V80h-48v31.5c0 11.5 2.5 22.5 6.9 32.5 12.6 28.2 40.9 48 73.6 48h112c44.2 0 79.5-36.3 79.5-80.5v-32C384 35.3 348.7 0 304.5 0z"/><path d="M265.6 48c-12.1-28.3-40.1-48-73.1-48h-112C36.3 0 0 35.3 0 79.5v32C0 155.7 36.3 192 80.5 192H128s-25.8-17-32.1-48H80.5C62.9 144 48 129.1 48 111.5v-32C48 61.9 62.9 48 80.5 48h112c17.6 0 31.5 13.9 31.5 31.5V112h48V79.5c0-11.2-2.3-21.9-6.4-31.5z"/></svg>
          `
        }
      },
      taskStatus (value){
        if (value == 'انجام نشده') {
          return `
            <div class="bg-pink p-1 px-2 rounded text-white">${value}</div>
          `
        }else if(value == 'در حال انجام'){
          return `
            <div class="bg-teal p-1 px-2 rounded text-white">${value}</div>
          `
        }else if(value == 'انجام شده'){
          return `
            <div class="bg-green p-1 px-2 rounded text-white">${value}</div>
          `
        }
      },
      reportStatus (value){
        if (value == 'عدم ارسال') {
          return `
            <div class="bg-pink p-1 px-2 rounded text-white">${value}</div>
          `
        }else if(value == 'با تاخیر'){
          return `
            <div class="bg-teal p-1 px-2 rounded text-white">${value}</div>
          `
        }else if(value == 'به موقع'){
          return `
            <div class="bg-green p-1 px-2 rounded text-white">${value}</div>
          `
        }
      },
      substring (value) {
        value = value.replace(/&nbsp;/gi," ")
        value = value.replace(/(<([^>]+)>)/ig,"")
        return value.length <= 18 ? value : value.substring(0,18) + ' ...'
      },
      long_substring (value) {
        value = value.replace(/&nbsp;/gi," ")
        value = value.replace(/(<([^>]+)>)/ig,"")
        return value.length <= 30 ? value : value.substring(0,30) + ' ...'
      },
      customer_type (value){
        if (value == 'حقیقی') {
          return `
            <div class="bg-teal p-1 px-2 rounded text-white">${value}</div>
          `
        }else if(value == 'حقوقی'){
          return `
            <div class="bg-indigo p-1 px-2 rounded text-white">${value}</div>
          `
        }
      },
      deliver_status (value){
        if (value == true) {
          return `
            <div class="bg-green p-1 px-2 rounded text-white">تکمیل شده</div>
          `
        }else{
          return `
            <div class="bg-blue p-1 px-2 rounded text-white">تکمیل نشده</div>
          `
        }
      },
      payed (value){
        if (value == true) {
          return `
            <div class="bg-green p-1 px-2 rounded text-white w-24 mx-auto">موفق</div>
          `
        }else{
          return `
            <div class="bg-pink p-1 px-2 rounded text-white w-24 mx-auto">ناموفق</div>
          `
        }
      },
      blacklist_status (value){
        if (value == 1) {
          return `
            <div class="bg-grey p-1 px-2 rounded text-white">پایان یافته</div>
          `
        }
        if (value == 2) {
          return `
            <div class="bg-pink p-1 px-2 rounded text-white">کمبود شارژ</div>
          `
        }
        if (value == 0) {
          return `
            <div class="bg-teal p-1 px-2 rounded text-white">صف</div>
          `
        }
      },
      blacklist_send_type (value){
        if (value === 0) {
          return `
            <div class="p-1 px-2 rounded text-grey-darkest bg-yellow-dark">پیامکی</div>
          `
        }else{
          return `
            <div class="bg-purple-light p-1 px-2 rounded text-white">صوتی</div>
          `
        }
      },
      refund (value){
        if (value != 0) {
          return `
            <div class="bg-orange p-1 px-2 rounded text-white w-12 mx-auto">
              <svg class="w-4 fill-current align-middle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 425.39996337890625 395.1000061035156"><path d="M404.2 13.4c-17.3-13.4-41.5-9.3-54.1 9.1L170.2 285.7 71.1 178.4C56.5 161.8 32 161 16.4 176.6.8 192.1 0 218.2 14.7 234.7c0 0 120.4 133.6 137.7 147 17.3 13.4 41.5 9.3 54.1-9.1L412.8 70.9c12.6-18.5 8.7-44.2-8.6-57.5z"/></svg>
            </div>
          `
        }else{
          return `
            <div class="bg-grey p-1 px-2 rounded text-white w-12 mx-auto">
              <svg class="w-4 fill-current align-middle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M437.5 386.6L306.9 256l130.6-130.6c14.1-14.1 14.1-36.8 0-50.9-14.1-14.1-36.8-14.1-50.9 0L256 205.1 125.4 74.5c-14.1-14.1-36.8-14.1-50.9 0-14.1 14.1-14.1 36.8 0 50.9L205.1 256 74.5 386.6c-14.1 14.1-14.1 36.8 0 50.9 14.1 14.1 36.8 14.1 50.9 0L256 306.9l130.6 130.6c14.1 14.1 36.8 14.1 50.9 0 14-14.1 14-36.9 0-50.9z"/></svg>
            </div>
          `
        }
      },
      number_format (value){
        return new Intl.NumberFormat({ maximumSignificantDigits: 3 }).format(value)
      },

      sms_recieve_status (value){
        if (value == 0) {
          return `
            <div class="bg-grey p-1 px-2 rounded text-white">بررسی نشده</div>
          `
        }
        if (value == 1) {
          return `
            <div class="bg-green p-1 px-2 rounded text-white">بررسی شده</div>
          `
        }
      },

      sms_recieve_code_state (value){
        if (value == 1) {
          return `
            <div class="bg-green p-1 px-2 rounded text-white">معتبر</div>
          `
        }
        if (value == 2) {
          return `
            <div class="bg-pink p-1 px-2 rounded text-white">نامعتبر</div>
          `
        }
        if (value == 3) {
          return `
            <div class="bg-indigo p-1 px-2 rounded text-white">تکراری</div>
          `
        }
      },

      tabiat_code_status (value){
        if (value == 0) {
          return `
            <div class="bg-grey p-1 px-2 rounded text-white">استفاده نشده</div>
          `
        }
        if (value == 1) {
          return `
            <div class="bg-green p-1 px-2 rounded text-white">استفاده شده</div>
          `
        }
      },

      file_export_status (value){
        if (value == 0) {
          return `
            <div class="bg-grey p-1 px-2 rounded text-white">بدون وضعیت</div>
          `
        }
        if (value == 1) {
          return `
            <div class="bg-teal p-1 px-2 rounded text-white">در حال آماده سازی</div>
          `
        }
        if (value == 2) {
          return `
            <div class="bg-green p-1 px-2 rounded text-white">موفق</div>
          `
        }
        if (value == 3) {
          return `
            <div class="bg-pink p-1 px-2 rounded text-white">ناموفق</div>
          `
        }
      },

      circle_progressbar(value){
        return `
        <div class="mx-auto w-16">
          <svg viewbox="0 0 36 36" class="circular-chart blue">
            <path class="circle-bg"
              d="M18 2.0845
                a 15.9155 15.9155 0 0 1 0 31.831
                a 15.9155 15.9155 0 0 1 0 -31.831"
            />
            <path class="circle"
              stroke-dasharray="${value}, 100"
              d="M18 2.0845
                a 15.9155 15.9155 0 0 1 0 31.831
                a 15.9155 15.9155 0 0 1 0 -31.831"
            />
            <text x="18" y="20.35" class="percentage">${value}%</text>
          </svg>
        </div>
        `
      },

      report_status (value){
        if (value == 0) {
          return `
            <div class="bg-grey p-1 px-2 rounded text-white">بدون وضعیت</div>
          `
        }
        if (value == 1) {
          return `
            <div class="bg-teal p-1 px-2 rounded text-white">در حال آماده سازی</div>
          `
        }
        if (value == 2) {
          return `
            <div class="bg-green p-1 px-2 rounded text-white">آماده شده</div>
          `
        }
      }
      

    }
}
</script>
