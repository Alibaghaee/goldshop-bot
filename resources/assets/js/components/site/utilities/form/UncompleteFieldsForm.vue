<template>
    <div class="w-full" id="register_form">

        <div class="leading-loose mb-4 text-2xl text-center font-medium" v-html="package.title"></div>

        <div v-if="step == 2" class="w-full flex justify-around flex-col h-full">
            <div class="leading-loose mb-16 text-base" v-html="package.first_description"></div>

            <div class="flex flex-wrap justify-around">
                <div v-if="can_pre_payment" class="my-2 no-underline bg-blue hover:bg-blue-dark rounded py-2 px-6 text-white cursor-pointer h-12 flex items-center justify-center text-center"
                @click="selectPaymentType(1)">رزرو و پیش ثبت نام <span class="font-bold mr-6">{{ formatNumber(package.pre_payment) }} ریال</span></div>
                <div v-if="can_full_payment" class="my-2 no-underline bg-blue hover:bg-blue-dark rounded py-2 px-6 text-white cursor-pointer h-12 flex items-center justify-center text-center"
                @click="selectPaymentType(2)">ثبت نام کامل و قطعی <span class="font-bold mr-6">{{ formatNumber(package.price) }} ریال</span></div>
                <div v-if="can_supplementary_payment" class="my-2 no-underline bg-blue hover:bg-blue-dark rounded py-2 px-6 text-white cursor-pointer h-12 flex items-center justify-center text-center"
                @click="selectPaymentType(3)">پرداخت تکمیلی <span class="font-bold mr-6">{{ formatNumber(package.user_supplementary_price) }} ریال</span></div>
            </div>
            
        </div>

        <form class="" @submit.prevent="onUserInfoFormSubmit(package.fill_out_profile_store_url)" @keydown="form.errors.clear($event.target.name)" v-if="step == 3">

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
                    <div class="no-underline bg-pink hover:bg-pink-dark rounded py-2 px-6 text-white cursor-pointer h-12 flex items-center justify-center text-center" @click="step = 2">بازگشت</div>
                </slot>
                <!-- <div class="bg-pink hover:bg-pink-dark rounded py-2 px-6 text-white cursor-pointer h-12 w-32 text-center block mx-auto mr-4" @click="jumpToStep(1)">
                    بازگشت
                </div> -->
              </div>
            </div>
        </form>

        <form class="" @submit.prevent="onConfirmFormSubmit(package.fill_out_profile_confirm_url)" @keydown="form.errors.clear($event.target.name)" v-if="step == 4">

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
        props: ['action', 'method', 'page_title', 'submit_text', 'genders', 'fields', 'provinces', 'cities', 'package', 'grades', 'fields_of_study', 'user', 'can_pre_payment', 'can_full_payment', 'can_supplementary_payment'],
        data () {
            return {
                endpoint: this.action,
                form_data: {},
                form: new Form(this.form_data),
                confirm_form_submit_result: {},
                national_code_form_submit_result: {},
                loading: false,
                step: 2
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
                return 'اینجانب ' + this.user.name + ' ' + this.user.family + ' به کد ملی ' + this.user.national_code + ' موارد بالا را به صورت کامل مطالعه کرده ام و تمام موارد بالا را پذیرفته ام.'
            }
        }
    }
</script>