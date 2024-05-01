<template>
    <section class="bg-form bg-cover bg-[center_631px] ">
        <div class="bg-black/70">
            <div class="container py-14 flex flex-col xl:flex-row items-center
         justify-between gap-24">
                <!-- contact form -->
                <div class="w-full text-center xl:w-2/4">
                    <div class=" text-white text-[15px] md:text-[20px] inline-block ">
                        <p class="p-2 border-b text-center">{{ item.name }}</p>

                        <div class="p-2 border-b" v-html="item.description"></div>
<!--                        <div class="p-2 border-b"  >جهت دریافت خدمات بیشتر ایمیل خود را وارد کنید</div>-->
                        <div class="mt-1 flex flex-col">
                            <input
                                v-model="form_data['fullname']"
                                class="border-b-2 p-1 border-white bg-transparent w-full block focus-visible:outline-none"
                                placeholder="نام و نام خانوادگى*" type="text" name="fullname">
                            <input
                                v-model="form_data['email']"
                                class="border-b-2 mt-4 p-1 border-white bg-transparent w-full block focus-visible:outline-none"
                                placeholder="ایمیل" type="email" name="email">
<!--                            <input-->
<!--                                v-model="form_data['mobile']"-->
<!--                                class="border-b-2 mt-4 p-1 border-white bg-transparent w-full block focus-visible:outline-none"-->
<!--                                placeholder="۰۹۱۲*" type="text" name="mobile">-->

<!--                            <input-->
<!--                                v-model="form_data['phone']"-->
<!--                                class="border-b-2 mt-4 p-1 border-white bg-transparent w-full block focus-visible:outline-none"-->
<!--                                placeholder="۰۲۱" type="text" name="phone">-->

<!--                            <textarea-->
<!--                                v-model="form_data['description']"-->
<!--                                cols="2" rows="2"-->
<!--                                class="border-b-2 mt-4 p-1 border-white bg-transparent w-full block focus-visible:outline-none"-->
<!--                                placeholder="توضیحات" type="text" name="description">-->

<!--                            </textarea>-->

                            <button
                                :disabled="loading"
                                @click="submitContactUs"
                                :class=" [loading === true ?'bg-grey-darker buttonloading ':'bg-primary']"
                                class="self-end mt-4 rounded-lg border-2 border-primary block-inline text-white px-8 py-1">
                                ارسال
                                <i class="fa fa-refresh fa-spin" v-if="loading"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- map -->
                <div id="map" class="bg-slate-900 w-full xl:w-2/4 h-[310px] z-[1]"></div>

            </div>
        </div>

    </section>
</template>

<script>
import {Form, FormErrors} from './../../form.js';

export default {

    props: ['item'],

    data() {

        return {
            loading: false,
            form_data: {},
            form: new Form(this.form_data),
        }
    },
    methods: {
        submitContactUs() {

            this.loading = true
            this.form = new Form(this.form_data)



            axios.post('/fa/contact-us', this.form_data)
                .then(function (response) {
                    flash('اطلاعات شما با موفقیت ثبت شد', 'success')
                    this.loading = false
                }.bind(this))
                .catch(function (error) {
                    flash('خطا در در انجام عملیات', 'error')
                    this.loading = false
                }.bind(this))
        },
    }
}
</script>
