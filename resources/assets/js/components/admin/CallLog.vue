<template>
  <div class="bg-grey w-full h-full rounded p-4 flex" id="call">
      <div class="bg-white rounded p-4 w-4/5 m-auto flex flex-col">
          
          <transition name="fade">
            <div v-if="message.length" v-text="message" class="bg-teal-light leading-normal mb-2 p-2 rounded text-center text-white"></div>
          </transition>

          <div v-if="isNewCustomer" class="px-4 py-2 bg-grey-lighter rounded mb-2 leading-normal text-blue-light">
            <div class="mb-3 text-center">مشتری جدید:</div>
            <div class="flex flex-wrap justify-between">
              <div class="bg-grey-lightest leading-none p-2 rounded" v-if="new_customer.mobile">موبایل: {{ new_customer.mobile }}</div>
              <div class="bg-grey-lightest leading-none p-2 rounded" v-if="new_customer.name">نام: {{ new_customer.name }}</div>
              <div class="bg-grey-lightest leading-none p-2 rounded" v-if="new_customer.family">نام خانوادگی: {{ new_customer.family }}</div>
            </div>
          </div>

          <multiselect 
            class="mb-4"
            placeholder="جستجوی مشتری"
            v-model="customer" 
            :loading="false"
            :close-on-select="true" 
            track-by="mobile"
            label="mobile"
            :custom-label="nameWithMobile"
            :options="customers" 
            :searchable="true" 
            :preserveSearch="true"
            dir="rtl"
            id="customer"
            @select="loadLogs"
            :options-limit="300"
            :limit="3"
            :max-height="600"
            :show-no-results="false"
            @search-change="printSearch"
            group-values="customers"
            group-label="type"
          >
          </multiselect>

          <div v-if="logs.length" v-for="log in logs">
            <div class="text-grey text-xs my-4 text-center" v-if="log.show_date" v-text="log.date"></div>
            <div class="flex mb-4">
                <div><img :src="log.avatar" class="w-12 ml-6"></div>
                <div class="triangle"></div>
                <div class="bg-grey-lighter mh-12 w-full rounded p-2">
                    <div class="flex justify-between text-xs text-grey mb-4">
                        <div v-text="log.fullname"></div>
                        <div v-text="log.time"></div>
                    </div>
                    <div class="leading-loose text-grey-dark" v-text="log.body"></div>
                </div>
            </div>
          </div>


          <textarea v-model="description" placeholder="متن مکالمه ..." id="description" class="leading-loose w-full border-0 h-32 rounded bg-grey-lighter p-2 text-grey-darker flex mt-auto" 
          @keydown.enter.ctrl.exact="newLine" 
          @keydown.enter.exact.prevent="submit"
          ></textarea>
      </div>
  </div>
</template>

<script>
  export default {
      data () {
          return {
            customer: '',
            customers: [],
            logs : [],
            description : '',
            search_text : '',
            new_customer: {},
            message: '',
          }
      },

      mounted (){
        this.customers = this.getCutomers();
      },

      computed : {
        isNewCustomer (){
          return !! this.search_text.length && !this.customer;
        },
      },

      watch : {
        search_text (val) {
          let new_customer = _.map(_.split(val, '-', 3), _.trim);
          this.new_customer.mobile = _.get(new_customer , '0');
          this.new_customer.name = _.get(new_customer , '1');
          this.new_customer.family = _.get(new_customer , '2');
        },

        customer (val) {
          if (!val) {
            this.logs = [];
          }
        },
      },


      methods: {
        getCutomers () {
            return [
              {
                'type' : 'مشتریان حقیقی',
                'customers' : [
                  {'type': '1', 'id': '44', 'mobile': '09354455664', 'fullname': 'فلان بیساریان'},
                  {'type': '1', 'id': '55', 'mobile': '09128877665', 'fullname': 'کاربر دوم'},
                ]
              },
              {
                'type' : 'مشتریان حقوقی',
                'customers' : [
                  {'type': '0', 'id': '66', 'mobile': '09354455664', 'fullname': 'فلان بیساریان'},
                  {'type': '0', 'id': '77', 'mobile': '09128877665', 'fullname': 'کاربر چهارم'},
                ]
              },
            ];
        },

        loadLogs () {
            let logs = [
              {
                'user_id' : 2,
                'avatar' : '/image/avatar/avatar.png',
                'fullname' : 'پشتیبان فروش',
                'date' : 'یکشنبه، 20 مهر 1397',
                'time' : '11:35',
                'body': 'نرم افزار ارسال ایمیل ما با کارایی بالا و سادگی کامل نیازهای واقعی شما.'
              },
              {
                'user_id' : 2,
                'avatar' : '/image/avatar/avatar.png',
                'fullname' : 'پشتیبان هاست',
                'date' : 'یکشنبه، 20 مهر 1397',
                'time' : '11:50',
                'body': 'نرم افزار ارسال ایمیل ما با کارایی بالا و سادگی کامل نیازهای واقعی شما را در حوزه ایمیل مارکتینگ و ارسال ایمیل گروهی پوشش می دهد.'
              },
              {
                'user_id' : 2,
                'avatar' : '/image/avatar/avatar.png',
                'fullname' : 'پشتیبان سرور',
                'date' : 'یکشنبه، 21 مهر 1397',
                'time' : '08:50',
                'body': 'نرم افزار ارسال ایمیل ما با کارایی بالا و سادگی کامل نیازهای واقعی شما را در حوزه ایمیل مارکتینگ و ارسال ایمیل گروهی پوشش می دهد.'
              }
            ];

            this.logs = this.showDateControl(logs);
        },
        newLine () {
            $('#description').val($('#description').val() + "\n");
        },
        submit () {
            this.reset()
            this.flash('تماس با موفقیت ثبت شد.')
            this.loadLogs();
        },
        nameWithMobile ({ mobile, fullname }) {
          return `${mobile} — ${fullname}`
        },
        printSearch (query){
          this.search_text = query;
        },
        showDateControl (logs){
            return _.forEach(logs, function(log, key){
              if (key == 0) {
                logs[key].show_date = true;
              }
              else if (log.date != logs[key-1].date) {
                logs[key].show_date = true;
              }
              else{
                log.show_date = false;
              }
            });
        },
        flash (text) {
          this.message = text;
          setTimeout(function(){
            this.message = '';
          }.bind(this), 3000);
        },

        reset (){
          this.customer = '';
          this.logs  = [];
          this.description  = '';
          this.search_text  = '';
          this.new_customer = {};
        }
      }
  }
</script>

<style>
  .triangle{
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 10px 0 10px 13px;
    border-color: transparent transparent transparent #f1f5f8;
    position: relative;
    top: 10px;
  }

  .fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
  }
  .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
  }
  input:focus, textarea:focus {
    outline:none;
  }
</style>