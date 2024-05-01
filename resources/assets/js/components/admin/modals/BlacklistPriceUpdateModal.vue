<template>
  <modal name="blacklist-price-update" :width="400" :height="450">
      <div class="flex flex-col justify-between p-8 h-full">
        <div class="text-center text-xl text-grey-darker leading-normal">به روز رسانی هزینه ارسال بلک لیست 
          <span v-text="data.user_fullname" v-if="data.user_fullname" class="text-red font-bold"></span>
        </div>

        <div class="mt-6">
          <label class="block text-right leading-loose text-grey-darker" for="user_price">قیمت بلک لیست کاربر (ریال):</label>
          <input 
              id="user_price" 
              v-model="user_price"
              class="rhc-form-control text-grey-dark" 
          ></input>
        </div>
        <div class="text-pink rtl text-right mt-2" v-if="form.errors.has('user_price')" v-text="form.errors.get('user_price')"></div>
        <div class="mt-2">
          <label class="block text-right leading-loose text-grey-darker" for="admin_price">قیمت بلک لیست مدیر (ریال):</label>
          <input 
              id="admin_price" 
              v-model="admin_price"
              class="rhc-form-control text-grey-dark" 
          ></input>
        </div>
        <div class="text-pink rtl text-right mt-2" v-if="form.errors.has('admin_price')" v-text="form.errors.get('admin_price')"></div>

        <div class="flex justify-between items-end h-full">
            <button type="button" class="rhc-btn rhc-btn-green" @click="updatePrice">تایید</button>
            <button type="button" class="rhc-btn" @click="$modal.hide('blacklist-price-update')">انصراف</button>
        </div>
      </div>
  </modal>
</template>

<script>

import { Form, FormErrors } from './../../../form.js';

export default {
    data (){
        return {
            form_data: {},
            form: new Form(this.form_data),
            data: '',
            user_price: '',
            admin_price: '',
        }
    },

    created (){
        console.log('blacklistPriceUpdateModal created ...');
        window.events.$on('blacklistPriceUpdateModal', data => this.showDialog(data));
    },

    methods :{
      showDialog (data){
        this.$modal.show('blacklist-price-update')
        this.form.errors.clear()
        this.data = data.data.data
        this.user_price = this.data.blacklist_price_for_user
        this.admin_price = this.data.blacklist_price_for_admin
      },
      
      updatePrice (){
        let endpoint = "/blacklist_price/blacklist_price";
        this.form_data = {
          user_id: this.data.user_id,
          user_price: parseInt(this.user_price),
          admin_price: parseInt(this.admin_price),
        }

        this.form = new Form(this.form_data)
        this.form['put'](endpoint)
        .then(function (response){
          this.updated(response);
        }.bind(this))
        .catch(function(error){
          flash('خطا در در انجام عملیات', 'error')
        });
      }, 

      updated (data) {
        if (data.result == true) {
          flash('عملیات با موفقیت انجام شد.')
        }else{
          flash('امکان انجام عملیات وجود ندارد.', 'error')
        }
        this.$events.fire('reload')
        this.$modal.hide('blacklist-price-update')
      }
  }
  
}
</script>