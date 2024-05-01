<template>
    <div class="w-full">

        <form class="" @submit.prevent="onFormSubmit('/fa/pay')" @keydown="form.errors.clear($event.target.name)" v-if="true">

            <div class="leading-loose mb-3 text-base" v-html="descriptions.one"></div>

            <div class="flex flex-wrap -mx-2">

                <div class="w-full md:w-1/2 px-2">
                    <i-text 
                        type="text" 
                        :form="form" 
                        :form_data="form_data" 
                        name="national_code" 
                        title="کد ملی داوطلب *"
                    ></i-text>
                </div>

                <div class="w-full md:w-1/2 px-2">
                    <i-text 
                        type="text" 
                        :form="form" 
                        :form_data="form_data" 
                        name="mobile" 
                        title="تلفن همراه داوطلب *"
                    ></i-text>
                </div>


                <div class="w-full md:w-1/2 px-2">
                    <i-text 
                        type="text" 
                        :form="form" 
                        :form_data="form_data" 
                        name="name" 
                        title="نام داوطلب *"
                    ></i-text>
                </div>
                <div class="w-full md:w-1/2 px-2">
                    <i-text 
                        type="text" 
                        :form="form" 
                        :form_data="form_data" 
                        name="family" 
                        title="نام خانوادگی داوطلب *"
                    ></i-text>
                </div>

                <div class="w-full md:w-1/2 px-2">
                    <i-text 
                        type="text" 
                        :form="form" 
                        :form_data="form_data" 
                        name="phone" 
                        title="تلفن ثابت با کد شهر محل سکونت"
                    ></i-text>
                </div>
                <div class="w-full md:w-1/2 px-2">
                    <i-text 
                        type="text" 
                        :form="form" 
                        :form_data="form_data" 
                        name="emergency_mobile" 
                        title="تلفن همراه یکی از بستگان یا اولیاء *"
                    ></i-text>
                </div>

                <div class="w-full md:w-1/2 px-2">
                    <i-multiselect 
                        :form="form" 
                        :form_data="form_data" 
                        name="gender" 
                        title="جنسیت *"
                        :options="genders" 
                    ></i-multiselect>
                </div>

                <div class="w-full md:w-1/2 px-2">
                    <i-multiselect 
                        :form="form" 
                        :form_data="form_data" 
                        name="grade" 
                        title="مقطع تحصیلی *"
                        :options="grades" 
                    ></i-multiselect>              
                </div>

                <div class="w-full md:w-1/2 px-2">
                    <i-multiselect 
                        :form="form" 
                        :form_data="form_data" 
                        name="field_of_study" 
                        title="رشته تحصیلی *"
                        :options="fields_of_study" 
                    ></i-multiselect>              
                </div>

                <!-- <div class="w-full md:w-1/2 px-2">
                    <i-multiselect 
                        :form="form" 
                        :form_data="form_data" 
                        name="field" 
                        title="رشته اصلی در کنکورسراسری *"
                        :options="fields" 
                    ></i-multiselect>              
                </div> -->

                <div class="w-full md:w-1/2 px-2">
                    <i-multiselect 
                        :form="form" 
                        :form_data="form_data" 
                        name="payment_subject" 
                        title="موضوع پرداخت *"
                        :options="payment_subjects" 
                    ></i-multiselect>              
                </div>

                <div class="w-full md:w-1/2 px-2 flex flex-wrap">
                    <i-textarea 
                        type="text" 
                        :form="form" 
                        :form_data="form_data" 
                        name="payment_description" 
                        title="شرح پرداخت"
                    ></i-textarea>
                    <div class="w-full mb-4 text-grey-dark -mt-2 text-sm">لطفا حداکثر در 2 خط شرح دهید مبلغ پرداختی بابت چه چیزی است.</div>
                </div>

                <div class="w-full md:w-1/2 px-2">
                    <i-province 
                        :form="form" 
                        :form_data="form_data" 
                    ></i-province>         
                </div>

                <div class="md:w-1/2 px-2 w-full">
                    <div class="flex items-baseline justify-between">
                        <div class="md:w-3/4 w-full">
                            <i-text 
                                type="text" 
                                :form="form" 
                                :form_data="form_data" 
                                name="price" 
                                title="مبلغ پرداختی *"
                            ></i-text>
                        </div>
                        <div class="md:w-1/4 pr-3 text-grey-darkest w-full rhc-form-control text-left">ریال</div>
                    </div>

                    <div class="w-full mb-4 text-grey-dark -mt-2 text-sm">لطفا اعداد را با صفحه کلید انگلسی وارد کنید.</div>

                    <div class="w-full leading-normal" v-if="form_data.price">
                        <div>{{ formatedPrice }} ریال</div>
                        <div>{{ formatedPricePersion }} تومان</div>
                    </div>
                </div>

            </div>

            <div class="flex justify-center m-4" v-if="loading">
                <div class="lds-default"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            </div>

            <div class="md:flex md:items-center mt-6" v-if="!loading">
              <div class="w-full flex flex-wrap">
                <slot name="submit">
                    <!-- default submit button if not replace with something else -->
                    <button class="mb-2 bg-teal rounded-full border-2 border-grey-lightest px-8 py-3 no-underline text-center block text-xl text-grey-lightest hover:bg-white hover:text-teal hover:border-teal mx-auto" type="submit">
                        <span v-if="submit_text" v-text="submit_text"></span>
                        <span v-else>تایید و رفتن به درگاه بانک</span>
                    </button>
                </slot>
              </div>
            </div>
        </form>

    </div>
</template>

<script>
    import { Form, FormErrors } from './../../../../form.js';
    import accounting from 'accounting'
    import Num2persian from 'num2persian';

    export default {
        props: ['action', 'method', 'page_title', 'submit_text', 'genders', 'fields', 'provinces', 'cities', 'descriptions', 'grades', 'fields_of_study', 'payment_subjects'],
        data () {
            return {
                endpoint: this.action,
                form_data: {},
                form: new Form(this.form_data),
                national_code_form_submit_result: {},
                loading: false,
                step: 1
            }
        },
        methods: {
           onFormSubmit (endpoint){
                this.loading = true
                this.form = new Form(this.form_data)
                this.form[this.method](endpoint)
                    .then(function(response){
                        this.loading = false
                        this.step = 3;
                    }.bind(this))
                    .catch(function(){
                        this.loading = false
                    }.bind(this));
            },
            jumpToStep(step){
                this.step = step
            },
            formatNumber (value) {
              return accounting.formatNumber(value, 0)
            },
            toEnglishDigit(value) { 
                var find    = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
                var replace = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
                var replaceString = value;
                var regex;
                for (var i = 0; i < find.length; i++) { 
                    regex = new RegExp(find[i], "g");
                    replaceString = replaceString.replace(regex, replace[i]);
                } 
                return replaceString; 
            }
            
        },
        watch: {
            form_data(val){
                // console.log(val);
            }
        },
        computed: {
            formatedPrice: function () {
                return this.formatNumber(this.toEnglishDigit(this.form_data.price))
            },
            formatedPricePersion: function () {
                return (this.toEnglishDigit(this.form_data.price) / 10).num2persian()
            },
        }
    }
</script>