<template>
    <div class="w-full" id="register_form">

        <div class="leading-loose mb-4 text-2xl text-center font-medium" v-html="package.title"></div>

        <form class="" @submit.prevent="onNationalCodeFormSubmit('/fa/registration/check_national_code')" @keydown="form.errors.clear($event.target.name)" v-if="step == 1">

            <div class="leading-loose mb-16 text-base" v-html="package.national_code_description"></div>

            <div>
                <i-text 
                    type="text" 
                    :form="form" 
                    :form_data="form_data" 
                    name="national_code" 
                    title="کد ملی داوطلب"
                ></i-text>
            </div>

            <div v-if="national_code_form_submit_result.national_code_exists" class="bg-blue-light rounded text-white p-4">
                <div>اطلاعات شما قبلا در سامانه ثبت شده است. جهت ورود به پنل کاربری و خرید پکیج وارد لینک زیر شوید.</div>
                <a href="/fa/login" class="rhc-btn rhc-btn-white text-grey inline-block mt-4">ورود</a>
            </div>

            <div class="flex justify-center m-4" v-if="loading">
                <div class="lds-default"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            </div>

            <div class="md:flex md:items-center mt-8" v-if="!loading && !national_code_form_submit_result.national_code_exists">
              <div class="w-full">
                <slot name="submit">
                    <!-- default submit button if not replace with something else -->
                    <button class="bg-purple hover:bg-purple-dark rounded py-2 px-6 text-white cursor-pointer h-12 w-32 text-center block mx-auto" type="submit">
                        <span v-if="submit_text" v-text="submit_text"></span>
                        <span v-else>تایید</span>
                    </button>
                </slot>
              </div>
            </div>

        </form>

        <div v-if="step == 2" class="w-full flex justify-around flex-col h-full">
            <div class="leading-loose mb-16 text-base" v-html="package.first_description"></div>

            <div class="flex flex-wrap justify-around">
                <div v-if="package.allow_installment" class="my-2 no-underline bg-blue hover:bg-blue-dark rounded py-2 px-6 text-white cursor-pointer h-12 flex items-center justify-center text-center"
                @click="selectPaymentType(1)">رزرو و پیش ثبت نام</div>
                <div class="my-2 no-underline bg-blue hover:bg-blue-dark rounded py-2 px-6 text-white cursor-pointer h-12 flex items-center justify-center text-center"
                @click="selectPaymentType(2)">ثبت نام کامل و قطعی</div>
            </div>
            
        </div>

        <form class="" @submit.prevent="onUserInfoFormSubmit(package.store_url)" @keydown="form.errors.clear($event.target.name)" v-if="step == 3">

            <div class="leading-loose mb-3 text-base" v-html="package.second_description"></div>

            <div class="flex flex-wrap -mx-2">

                <slot name="inputs" :form="form" :form_data="form_data">
                    No Inputs ...
                </slot>

            </div>

            <div class="flex justify-center m-4" v-if="loading">
                <div class="lds-default"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            </div>

            <div class="md:flex md:items-center mt-6" v-if="!loading">
              <div class="w-full flex flex-wrap justify-around">
                <slot name="submit">
                    <!-- default submit button if not replace with something else -->
                    <button class="bg-purple hover:bg-purple-dark rounded py-2 px-6 text-white cursor-pointer h-12 text-center block" type="submit">
                        <span v-if="submit_text" v-text="submit_text"></span>
                        <span v-else>تایید و رفتن به مرحله بعد</span>
                    </button>
                    <div class="no-underline bg-pink hover:bg-pink-dark rounded py-2 px-6 text-white cursor-pointer h-12 flex items-center justify-center text-center" @click="step = 1">بازگشت</div>
                </slot>
                <!-- <div class="bg-pink hover:bg-pink-dark rounded py-2 px-6 text-white cursor-pointer h-12 w-32 text-center block mx-auto mr-4" @click="jumpToStep(1)">
                    بازگشت
                </div> -->
              </div>
            </div>
        </form>

        <form class="" @submit.prevent="onConfirmFormSubmit(package.confirm_url)" @keydown="form.errors.clear($event.target.name)" v-if="step == 4">

            <div class="leading-loose mb-3 text-base" v-html="package.agreement_text"></div>

            <div class="my-8 font-medium">
                <i-checkbox 
                    :form="form" 
                    :form_data="form_data" 
                    name="confirm" 
                    :title="confirm_text"
                ></i-checkbox>
            </div>

            <div class="flex justify-center m-4" v-if="loading">
                <div class="lds-default"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            </div>

            <div class="md:flex md:items-center mt-6" v-if="!loading">
              <div class="w-full flex flex-wrap">
                <slot name="submit">
                    <!-- default submit button if not replace with something else -->
                    <button class="bg-purple hover:bg-purple-dark rounded py-2 px-6 text-white cursor-pointer h-12 text-center block mx-auto" type="submit">
                        <span v-if="submit_text" v-text="submit_text"></span>
                        <span v-else>تایید و پرداخت</span>
                    </button>
                </slot>
                <!-- <div class="bg-pink hover:bg-pink-dark rounded py-2 px-6 text-white cursor-pointer h-12 w-32 text-center block mx-auto mr-4" @click="jumpToStep(2)">
                    بازگشت
                </div> -->
              </div>
            </div>
        </form>

    </div>
</template>

<script>
    import { Form, FormErrors } from './../../../../form.js';
    import accounting from 'accounting'

    export default {
        props: ['action', 'method', 'page_title', 'submit_text', 'genders', 'fields', 'provinces', 'cities', 'package', 'grades', 'fields_of_study'],
        data () {
            return {
                endpoint: this.action,
                form_data: {},
                form: new Form(this.form_data),
                confirm_form_submit_result: {},
                national_code_form_submit_result: {},
                loading: false,
                step: 1
            }
        },
        methods: {
            onConfirmFormSubmit (endpoint){
                this.loading = true
                this.form = new Form(this.form_data)
                this.form[this.method](endpoint)
                    .then(function(response){
                        this.loading = false
                        this.confirm_form_submit_result = response;
                        this.checkStep();
                    }.bind(this))
                    .catch(function(){
                        this.loading = false
                    }.bind(this));
            },
            onNationalCodeFormSubmit (endpoint){
                this.loading = true
                this.form = new Form(this.form_data)
                this.form[this.method](endpoint)
                    .then(function(response){
                        this.loading = false
                        this.national_code_form_submit_result = response;
                        this.checkStep();
                    }.bind(this))
                    .catch(function(){
                        this.loading = false
                    }.bind(this));
            },
            onUserInfoFormSubmit (endpoint){
                this.loading = true
                this.form = new Form(this.form_data)
                this.form[this.method](endpoint)
                    .then(function(response){
                        this.loading = false
                        this.step = 4;
                    }.bind(this))
                    .catch(function(){
                        this.loading = false
                    }.bind(this));
            },
            checkStep(){
                if (this.national_code_form_submit_result.national_code_exists == false) {
                    this.step = 2
                }
                if (this.confirm_form_submit_result.status == true && this.confirm_form_submit_result.supplementary_registration == true) {
                    this.step = 4
                }
            },
            jumpToStep(step){
                this.step = step
            },
            formatNumber (value) {
              return accounting.formatNumber(value, 0)
            },
            selectPaymentType(id){
                this.form_data.payment_type = id
                this.jumpToStep(3)
            }
            
        },
        watch: {
            form_data(val){
                // console.log(val);
            }
        },
        computed: {
            confirm_text(){
                return 'اینجانب ' + this.form_data.name + ' ' + this.form_data.family + ' به کد ملی ' + this.form_data.national_code + ' موارد بالا را به صورت کامل مطالعه کرده ام و تمام موارد بالا را پذیرفته ام.'
            }
        }
    }
</script>