<template>
    <div class="w-full p-8">

        <div class="w-full md:w-1/2 mx-auto">
            <div class="md:flex md:items-center mb-4">
                <span class="text-pink">{{ vErrors.first('throttle') }}</span>
                <div class="text-pink" v-if="form.errors.has('throttle')" v-text="form.errors.get('throttle')"></div>
            </div>
        </div>

        <form @submit.prevent="checkNationalCode('/fa/refund/check_national_code')" @keydown="form.errors.clear($event.target.name)" v-if="step == 1">

            <div class="leading-loose mb-3 text-base" v-html="descriptions.one"></div>

            <div class="w-full md:w-1/2 mx-auto">
                <i-text 
                    type="text" 
                    :form="form" 
                    :form_data="form_data" 
                    name="national_code" 
                    title="کد ملی که با آن ثبت نام کرده بودید"
                ></i-text>
            </div>


            <div class="md:flex md:items-center mt-8" v-if="!loading">
              <div class="w-full">
                <slot name="submit">
                    <button class="h-btn-teal" type="submit">تایید</button>
                </slot>
              </div>
            </div>
        </form>

        <form @submit.prevent="requestCodeSubmit('/fa/refund/request_code')" @keydown="form.errors.clear($event.target.name)" v-if="step == 2">

            <!-- <div class="leading-loose mb-3 text-base" v-html="descriptions.two"></div> -->

            <div class="flex flex-wrap my-3 -mx-2">
                <div class="w-full md:w-1/3 mb-2 px-2">
                  <div class="bg-grey-light px-3 py-2 rounded">
                    <label class="font-bold">نام: </label>
                    <span>{{user.name}}</span>
                  </div>
                </div>
                <div class="w-full md:w-1/3 mb-2 px-2">
                  <div class="bg-grey-light px-3 py-2 rounded">
                    <label class="font-bold">نام خانوادگی: </label>
                    <span>{{user.family}}</span>
                  </div>
                </div>
                <div class="w-full md:w-1/3 mb-2 px-2">
                  <div class="bg-grey-light px-3 py-2 rounded">
                    <label class="font-bold">جنسیت: </label>
                    <span>{{user.gender_title}}</span>
                  </div>
                </div>
                <div class="w-full md:w-1/3 mb-2 px-2">
                  <div class="bg-grey-light px-3 py-2 rounded">
                    <label class="font-bold">کد ملی: </label>
                    <span>{{user.national_code}}</span>
                  </div>
                </div>
                <div class="w-full md:w-1/3 mb-2 px-2">
                  <div class="bg-grey-light px-3 py-2 rounded">
                    <label class="font-bold">استان: </label>
                    <span>{{user.province_title}}</span>
                  </div>
                </div>
                <div class="w-full md:w-1/3 mb-2 px-2">
                  <div class="bg-grey-light px-3 py-2 rounded">
                    <label class="font-bold">شهر: </label>
                    <span>{{user.city_title}}</span>
                  </div>
                </div>
                <div class="w-full md:w-1/2 mb-2 px-2">
                  <div class="bg-grey-light px-3 py-2 rounded">
                    <label class="font-bold">موبایل: </label>
                    <span class="dir-ltr inline-block">{{user.mobile}}</span>
                  </div>
                </div>
                <div class="w-full md:w-1/2 mb-2 px-2">
                  <div class="bg-grey-light px-3 py-2 rounded">
                    <label class="font-bold">تلفن تماس ضروری: </label>
                    <span class="dir-ltr inline-block">{{user.emergency_mobile}}</span>
                  </div>
                </div>
                <div class="w-full md:w-1/3 mb-2 px-2">
                  <div class="bg-grey-light px-3 py-2 rounded">
                    <label class="font-bold">رشته تحصیلی: </label>
                    <span>{{user.field_title}}</span>
                  </div>
                </div>
                <div class="w-full md:w-2/3 mb-2 px-2">
                  <div class="bg-grey-light px-3 py-2 rounded">
                    <label class="font-bold">مجموع مبلغ پرداختی:</label>
                    <span>{{formatNumber(user.total_payments_price)}} ریال</span>
                  </div>
                </div>
            </div>

            <div class="text-xl font-bold mt-6 mb-3 ">پرداخت ها:</div>
            <div class="flex flex-wrap -mx-2" v-for="(payment, index) in user.payments">
                <div class="w-full md:w-1/3 mb-2 px-2">
                  <div class="bg-grey-light px-3 py-2 rounded">
                    <span>{{ ++index }} - {{ payment.title }}</span>
                  </div>
                </div>
                <div class="w-full md:w-1/3 mb-2 px-2">
                  <div class="bg-grey-light px-3 py-2 rounded">
                    <label class="font-bold">مبلغ: </label>
                    <span>{{ formatNumber(payment.price) }} ریال</span>
                  </div>
                </div>
                <div class="w-full md:w-1/3 mb-2 px-2">
                  <div class="bg-grey-light px-3 py-2 rounded">
                    <label class="font-bold">تاریخ: </label>
                    <span class="inline-block dir-ltr">{{ payment.created_at_fa }}</span>
                  </div>
                </div>
            </div>

            <div class="md:flex md:items-center mt-8" v-if="!loading">
              <div class="w-full">
                <slot name="submit">
                    <button class="h-btn-teal" type="submit">درخواست کد</button>
                </slot>
              </div>
            </div>
        </form>

        <form @submit.prevent="checkCode('/fa/refund/check_code')" @keydown="form.errors.clear($event.target.name)" v-if="step == 3">

            <div class="leading-loose mb-3 text-base" v-html="descriptions.two"></div>

            <div class="w-full md:w-1/2 mx-auto">
                <i-text 
                    type="text" 
                    :form="form" 
                    :form_data="form_data" 
                    name="code" 
                    title="کد پیامک شده"
                ></i-text>
            </div>

            <div class="md:flex md:items-center mt-8" v-if="!loading">
              <div class="w-full">
                <slot name="submit">
                    <button class="h-btn-teal" type="submit">تایید</button>
                </slot>
              </div>
            </div>
        </form>

        <form @submit.prevent="setIban('/fa/refund/set_iban')" @keydown="form.errors.clear($event.target.name)" v-if="step == 4">

            <div class="leading-loose mb-3 text-base" v-html="descriptions.three"></div>

            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 mx-auto">
                    <div class="flex flex-row w-full">
                        <i-text 
                            type="text" 
                            :form="form" 
                            :form_data="form_data" 
                            name="iban" 
                            title="شناسه شبا"
                            class="w-full"
                        ></i-text>
                        <div class="bg-grey-light mb-4 p-4 px-6 flex justify-center items-center rounded-l">IR</div>
                    </div>
                    <!-- <i-text 
                        type="text" 
                        :form="form" 
                        :form_data="form_data" 
                        name="account_owner" 
                        title="نام و نام خانوادگی صاحب حساب"
                    ></i-text> -->
                    <i-text 
                        v-if="iban_checked"
                        type="text" 
                        :form="form" 
                        :form_data="form_data" 
                        name="family_relationship" 
                        title="نسبت صاحب حساب با داوطلب"
                    ></i-text>
                    <!-- <i-text 
                        type="text" 
                        :form="form" 
                        :form_data="form_data" 
                        name="bank_name" 
                        title="نام بانک"
                    ></i-text> -->
                    
                    <div v-if="iban_checked" class="leading-loose mt-8">
                        <div>
                            <div class="font-bold">استعلام شبا:</div>
                            <div class="bg-grey-light px-3 py-2 rounded mb-2"><span class="font-bold">شبا: </span>{{ iban_api_data.result.IBAN }}</div>
                            <div class="bg-grey-light px-3 py-2 rounded mb-2"><span class="font-bold">نام بانک: </span>{{ iban_api_data.result.bankName }}</div>
                            <div class="bg-grey-light px-3 py-2 rounded mb-2"><span class="font-bold">شماره حساب: </span>{{ iban_api_data.result.deposit }}</div>
                            <div class="bg-grey-light px-3 py-2 rounded mb-2"><span class="font-bold">وضعیت: </span>{{ iban_api_data.result.depositDescription }}</div>
                            <div v-for="owner in iban_api_data.result.depositOwners">
                                <div class="bg-grey-light px-3 py-2 rounded mb-2"><span class="font-bold">نام : </span>{{ owner.firstName }}</div>
                                <div class="bg-grey-light px-3 py-2 rounded mb-2"><span class="font-bold">نام خانوادگی: </span>{{ owner.lastName }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:flex md:items-center mt-6" v-if="!loading">
              <div class="w-full flex flex-wrap">
                <slot name="submit">
                    <button class="h-btn-teal" type="submit">
                        <span v-if="!iban_checked">استعلام شبا</span>
                        <span v-else>ثبت درخواست استرداد وجه</span>
                    </button>
                </slot>
              </div>
            </div>
            
        </form>

        <div v-if="step == 5" class="bg-green leading-loose p-4 rounded text-center text-white text-xl">اطلاعات شما ثبت شد و مبلغ شما حداکثر تا 72 ساعت آینده به شماره شبای که اعلام کردید واریز می شود.</div>

        <div class="flex justify-center m-4" v-if="loading">
            <div class="lds-default"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>

    </div>
</template>

<script>
    import { Form, FormErrors } from './../../../../form.js';
    import accounting from 'accounting'

    export default {
        props: ['action', 'method', 'page_title', 'submit_text', 'descriptions'],
        data () {
            return {
                form_data: {},
                form: new Form(this.form_data),
                check_code_form_submit_result: {},
                loading: false,
                step: 1,
                user: {},
                iban_checked: false,
                iban_api_data: {}
            }
        },
        methods: {
            checkNationalCode(endpoint){
                this.loading = true
                this.form = new Form(this.form_data)
                this.form['post'](endpoint)
                    .then(function(response){
                        this.loading = false
                        if (!response.hasOwnProperty('redirect')) {
                            this.user = response.data;
                            this.step = 2;
                        }
                    }.bind(this))
                    .catch(function(){
                        this.loading = false
                    }.bind(this));
            },

            requestCodeSubmit(endpoint){
                this.loading = true
                this.form = new Form(this.form_data)
                this.form['post'](endpoint)
                    .then(function(response){
                        this.loading = false
                        if (!response.hasOwnProperty('redirect')) {
                            this.step = 3;
                        }
                    }.bind(this))
                    .catch(function(){
                        this.loading = false
                    }.bind(this));
            },

            checkCode(endpoint){
                this.loading = true
                this.form = new Form(this.form_data)
                this.form['post'](endpoint)
                    .then(function(response){
                        this.loading = false
                        this.step = 4;
                    }.bind(this))
                    .catch(function(){
                        this.loading = false
                    }.bind(this));
            },

            checkIban(endpoint){
                this.loading = true
                this.form = new Form(this.form_data)
                this.form['post'](endpoint)
                    .then(function(response){
                        this.loading = false
                        this.iban_checked = true
                        this.iban_api_data = response
                        this.form_data.bank_name = this.iban_api_data.result.bankName
                        this.form_data.account_owner = this.iban_api_data.result.depositOwners[0].firstName + ' ' + this.iban_api_data.result.depositOwners[0].lastName
                    }.bind(this))
                    .catch(function(){
                        this.loading = false
                    }.bind(this));
            },
            setIban(endpoint){
                if (!this.iban_checked) {
                    this.checkIban('/fa/refund/check_iban')
                }else{
                    this.loading = true
                    this.form = new Form(this.form_data)
                    this.form['post'](endpoint)
                        .then(function(response){
                            this.loading = false
                            this.step = 5;
                        }.bind(this))
                        .catch(function(){
                            this.loading = false
                        }.bind(this));
                }
            },
            jumpToStep(step){
                this.step = step
            },
            formatNumber (value) {
              return accounting.formatNumber(value, 0)
            },
            
        },
    }
</script>