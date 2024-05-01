<template>
  <div class="flex justify-center -mx-1">

    <a class="rhc-btn rhc-btn-sm rhc-action-btn" v-if="rowData.sendable_count != 0"
      @click="itemAction('blacklist_send')"
      v-html="icons.send"
      title="ارسال" 
    ></a>

    <a class="rhc-btn rhc-btn-sm rhc-action-btn rhc-btn-disabled" 
      v-else
      v-html="icons.send"
      title="ارسال" 
    ></a>

    <a class="rhc-btn rhc-btn-sm rhc-action-btn" :class="{ 'rhc-btn-disabled': rowData.status == 1}"
      @click="EndSend()"
      v-html="icons.stop"
      title="پایان ارسال" 
    ></a>

    <a class="rhc-btn rhc-btn-sm rhc-action-btn" :class="{ 'rhc-btn-disabled': rowData.sended_count == 0}"
      :href="rowData.sended_count ? rowData.sended_blacklists_export_url : 'javascript:void(0)'" 
      :target="rowData.sended_count ? '_blank' : '_self'" 
      v-html="icons.blacklist_list"
      :title="rowData.sended_count ? 'خروجی: ' + rowData.sended_count + ' گیرنده' : 'خروجی'" 
    ></a>

    <span v-if="rowData.status == 2" class="relative">
      <a class="rhc-btn rhc-btn-sm rhc-action-btn" 
        @click="sendSms()"
        v-html="icons.sms"
        title="ارسال پیامک کمبود شارژ" 
      ></a>
      <span 
        v-if="rowData.sended_sms_count_cache"
        class="absolute bg-blue bg-grey flex h-4 items-center justify-center ml-10 pt-1 rounded rounded-full text-sm text-white w-4"
        style="top: -7px; right: 19px;"
        v-html="rowData.sended_sms_count_cache"
       ></span>
    </span>
    <div v-else>
      <a class="rhc-btn rhc-btn-sm rhc-action-btn rhc-btn-disabled" 
        v-html="icons.sms"
        title="ارسال پیامک کمبود شارژ" 
      ></a>
    </div>

    <a class="rhc-btn rhc-btn-sm rhc-action-btn" 
      v-if="rowData.status == 2"
      @click="call()"
      v-html="icons.call"
      title="ارسال پیام صوتی کمبود شارژ" 
    ></a>
    <a class="rhc-btn rhc-btn-sm rhc-action-btn rhc-btn-disabled" 
      v-else
      v-html="icons.call"
      title="ارسال پیام صوتی" 
    ></a>

    


  </div>
</template>

<script>
import CustomActionsMixin from './../../mixins/CustomActionsMixin'

export default {
  mixins: [CustomActionsMixin],

  methods: {
      EndSend (){
          // if (this.rowData.status != 0) {
          //   return;
          // }
          axios['get']('/blacklists/blacklists/' + this.rowData.id + '/edit')
          .then(response => {
            flash('تغییر وضعیت با موفقیت انجام شد.')
            this.$events.fire('reload')
          })
          .catch(error => {
            flash('خطا در انجام عملیات.', 'error')
          });
      },
      sendSms (){
          axios['post']('/blacklists/blacklists/' + this.rowData.id + '/sms')
          .then(response => {
            flash('پیامک با موفقیت ارسال شد.')
            this.$events.fire('reload')
          })
          .catch(error => {
            flash('خطا در انجام عملیات.', 'error')
          });
      },
      call (){
          axios['post']('/blacklists/blacklists/' + this.rowData.id + '/call')
          .then(response => {
            flash('تماس صوتی با موفقیت ارسال شد.')
            this.$events.fire('reload')
          })
          .catch(error => {
            flash('خطا در انجام عملیات.', 'error')
          });
      },
      
  },
}
</script>
