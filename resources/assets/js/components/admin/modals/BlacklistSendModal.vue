<template>
  <modal name="blacklist-send" :width="450" :height="470" :adaptive="true">
      <div class="flex h-full flex-wrap">
        <form class="flex flex-col flex-wrap justify-between m-8 max-w-md w-full" @submit.prevent="onFormSubmit()">

          <div v-if="data">
            <!-- <div v-text="data.message" class="leading-loose overflow-y-auto rounded text-grey-dark text-right text-sm" style="max-height: 145px;"></div> -->

            <textarea 
                v-model="note"
                name="note"
                v-text="data.message"
                class="rhc-form-control leading-loose overflow-y-auto text-grey-dark text-sm" 
                style="height: 145px;"
                @keyup="showCheckbox"
            ></textarea>

            <div class="flex flex-wrap justify-between">
              <div class="font-light mt-2 text-blue-light text-xs" >تعداد کاراکترها: {{ note.length }}</div>
              <div class="font-light mt-2 text-blue-light text-xs" >تعداد پیامک: {{ noteParts }} / باقیمانده: {{ remained }}</div>
            </div>
          </div>

          <div class="w-full flex flex-row items-center justify-between mt-4" v-if="show_checkbox">
            <div>
              <label class="font-light mt-2 text-blue-light" for="old_parts">
                لحاظ کردن تغییرات صفحات پیامک:
              </label>
            </div>
            <div>
              <div class="form-switch inline-block align-middle">
                <input 
                  type="checkbox" 
                  id="old_parts" 
                  class="form-switch-checkbox" 
                  v-model="use_new_note_parts"
                  :value="true"
                />
                <label class="form-switch-label" for="old_parts"></label>
              </div>
            </div>
          </div>

          <hr class="border-dashed border w-full">

          <div class="flex justify-end" v-html="sendTypeLable"></div>

          <div class="w-full">
            <div class="flex mb-4 text-green-darkest">انتخاب درگاه ارسال:</div>
            <div class="mb-3">
              <multiselect 
              v-model="multiselect_value" 
              :close-on-select="true" 
              track-by="name" 
              :custom-label="operatorName"
              label="name"
              :options="options" 
              :searchable="true" 
              dir="rtl"
              :id="name"
              @select=""
              >
              </multiselect>

              <div class="text-pink rtl text-right mt-2" v-if="form.errors.has(name + '.id')" v-text="form.errors.get(name + '.id')"></div>

            </div>

            <button class="rhc-btn rhc-btn-green w-full" type="submit">
                <span>ارسال</span>
            </button>

          </div>

        </form>
      </div>

  </modal>
</template>

<script>

  import { Form, FormErrors } from './../../../form.js';

  export default {
      props: ['blacklist_send_options'],

      data () {
          return {
              endpoint: '/blacklists/blacklists/',
              form_data: {},
              form: new Form(this.form_data),
              multiselect_value: '',
              name: 'sender',
              data: '',
              note: '',
              use_new_note_parts: '',
              show_checkbox: false,
          }
      },
      methods: {
          onFormSubmit (){
            this.form = new Form(this.form_data)
            this.form['put'](this.endpoint + this.data.id)
                .then(function (response){
                  this.handleresponse(response);
                  this.$events.fire('reload')
                  this.use_new_note_parts = false
                  this.show_checkbox = false
                }.bind(this))
                .catch(function(error){
                  flash('خطا در عملیات', 'error')
                  // this.$events.fire('item-delete')
                });
          },

          handleresponse (data) {
            if (data.result == true) {
              flash(data.message, 'success')
              this.openInNewTab(data)
            }else{
              flash(data.message, 'info')
            }
            this.$modal.hide('blacklist-send')
          },
          showDialog (data){
            this.data = data.data.data
            this.note = this.data.message
            this.$modal.show('blacklist-send')
          },
          openInNewTab(data){
            if (this.form_data.sender.operator != 'export') {
              return;
            }
            var url = '/blacklist_send_logs/blacklist_send_logs?blacklist_id=' + this.data.id
            window.open(url,'_blank');
          },

          operatorName ({ name, description }) {
            if (typeof(description) == 'undefined' || description.length == 0) {
              return name
            }
            return `${name} — [ ${description} ]`
          },
          showCheckbox(){
            this.show_checkbox = true
          }
      },
      computed: {
        utf (){
          return this.note.search(/[^\x00-\x7D]/) != -1
        },
        unitLength (){
          var unit_length = this.utf ? 70 : 160;
          if (this.note.length <= unit_length) {
              return unit_length;
          }
          if (unit_length == 70){
              unit_length -= 3;
          }else {
              unit_length -= 7;
          }
          return unit_length;
        },
        noteParts (){
          return Math.ceil(this.note.length / this.unitLength)
        },
        remained(){
          return (this.unitLength * this.noteParts) - this.note.length
        },
        sendTypeLable(){
          if (this.data.blacklist_type === 0) {
            return '<div class="p-1 px-2 rounded text-grey-darkest bg-yellow-dark">پیامکی</div>';
          }
          if (this.data.blacklist_type === 1) {
            return '<div class="bg-purple-light p-1 px-2 rounded text-white">صوتی</div>';
          }
        },
        options(){
          if (!this.blacklist_send_options.length) {
            return;
          }
          if (this.data.blacklist_type === 1) {
            return _.filter(JSON.parse(this.blacklist_send_options), {'id': 1});
          }else{
            return JSON.parse(this.blacklist_send_options);
          }
        },
      },
      created (){
          console.log('blacklistSendModal created ...');
          console.log(this.data.blacklist_type);
          window.events.$on('blacklistSendModal', data => this.showDialog(data));
          this.use_new_note_parts = false;
      },
      watch : {
        multiselect_value (val){
          this.form_data[this.name] = val;
        },
        note (val){
          this.form_data['note'] = val;
        },
        use_new_note_parts (val){
          this.form_data['use_new_note_parts'] = val;
        },
      },
  }

</script>