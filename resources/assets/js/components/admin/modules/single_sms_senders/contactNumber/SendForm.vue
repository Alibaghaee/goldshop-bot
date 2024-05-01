<template>
    <div class="mt-10">
        <div class="flex h-full flex-wrap">
            <form class="w-1/2 flex flex-col flex-wrap justify-between m-8  w-full   rounded border-2 p-2"
                  @submit.prevent="onFormSubmit()">
                <div class="flex  ">
                    <div class="text-blue py-2"></div>

                    <div class="mr-5"></div>
                    <div class="text-blue py-2 mr-2 ">تعداد مخاطبین انتخاب شده :
                        <div class="inline text-blue font-bold">
                            {{ list.length }}
                        </div>

                    </div>
                    <div class="rhc-btn rhc-btn-pink m-2 " v-on:click="unselectAllContactNumber">بازنشانی</div>
                    <div class="rhc-btn rhc-btn-blue m-2" v-on:click="selectAllContactNumber">انتخاب صفحه</div>
                </div>

                <div class="w-1/3 ">
                    <i-multiselect
                        :form="form"
                        :form_data="form_data"
                        name="sender_number_id"
                        ref="sender_number_id"
                        title="شماره ارسال کننده"
                        :options="sender_numbers"
                    ></i-multiselect>


                    <!--                    <i-multiselect-->
                    <!--                        :form="form"-->
                    <!--                        :form_data="form_data"-->
                    <!--                        name="type"-->
                    <!--                        title="نوع"-->
                    <!--                        :options="this.type"-->
                    <!--                    ></i-multiselect>-->
                </div>
                <div v-if="form_data['sender_number_id']">
                    <div class="text-blue py-2">شارژ پنل:
                        {{ changeFormat(panel_charge) }}
                        <span class="text-green px-1">﷼</span>
                    </div>
                    <div class="mx-2 px-2 text-right">
                        <div id="sms_counter" ref="sms_counter" class="text-right" @change="checkSMSLength()"></div>
                    </div>
                    <textarea
                        id="description"
                        @click="checkSMSLength()" @change="checkSMSLength()" @keydown="checkSMSLength()"
                        @keyup="checkSMSLength()" ref="description"
                        v-model="description"
                        name="description"
                        placeholder="متن ارسالی"
                        class="rhc-form-control leading-loose overflow-y-auto text-grey-dark text-sm border rounded"
                        style="height: 145px;"

                    ></textarea>

                </div>


                <div class="w-full">
                    <button class="mx-auto w-full lg:w-fit block rhc-btn rhc-btn-green  mt-10  p-2" type="submit"
                            style="width:4rem;">
                        <span>ارسال</span>
                    </button>
                </div>
            </form>
        </div>

    </div>
</template>

<script>

import {Form} from "../../../../../form";
import {EventBus} from "../../../../../event-bus";

export default {

    props: [
        'action_url',
        'type',
        'sender_numbers',
        'sender_numbers_without_type',
    ],
    data() {
        return {
            endpoint: '/single_sms_senders/single_sms_senders',
            form_data: {},
            form: new Form(this.form_data),

            data: '',
            panel_charge: '',

            description: '',
            list: [],

        }
    },
    mounted() {


        this.addSMSCounter();
    },
    methods: {
        changeFormat(price) {

            let IRRial = new Intl.NumberFormat('fa');

            return IRRial.format(price*1)
        },
        onFormSubmit() {

            this.form_data.description = this.description;
            this.form_data.contactNumber_ids = JSON.stringify(this.list);

            this.form = new Form(this.form_data)

            this.form['post'](this.endpoint)
                .then(function (response) {
                    this.handleresponse(response);
                    this.form.reset();
                    this.$events.fire('reload')
                }.bind(this))
                .catch(function (error) {
                    flash('خطا در عملیات', 'error')

                });
        },
        handleresponse(data) {
            if (data.result == true) {
                flash(data.message, 'success')
                // this.openInNewTab(data)
            } else {
                flash(data.message, 'info')
            }
        },

        selectAllContactNumber(event) {

            EventBus.$emit('contactNumbersSelectionCond', 'selected_all');
        },
        unselectAllContactNumber(event) {

            EventBus.$emit('contactNumbersSelectionCond', 'unselected_all');
        },
        addSMSCounter() {
            if (this.form_data['sender_number_id']) {
                this.$refs.sms_counter.innerHTML = "تعداد کاراکتر باقیمانده : <span>160(1)</span>";
                this.checkSMSLength();
            }
        },
        checkSMSLength() {

            var text = this.description;
            var sender_number_id = this.form_data['sender_number_id'].id;

            var ucs2 = text.search(/[^\x00-\x7D]/) != -1
            // var mynumber = this.$refs.sender_number.value.trim()
            var mynumber = this.sender_numbers_without_type.find(l => l.id === sender_number_id).name.trim()
            var mypishvand = mynumber.substr(0, 1);
            var unitLength = ucs2 ? 70 : 160;
            if (text.length > unitLength) {
                if (ucs2) {
                    if (mypishvand == '5') {
                        unitLength = unitLength - 4;
                    } else {
                        unitLength = unitLength - 3;
                    }

                } else {
                    unitLength = unitLength - 7;
                }
            }

            var count = Math.max(Math.ceil(text.length / unitLength), 1);
            this.$refs.sms_counter.innerHTML = (unitLength * count - text.length) + '(' + count + ' پیامک)(' + text.length + ' کارکتر)';
        },

        getBalancePanel() {
            if (this.form_data['sender_number_id']) {

                let form_data = {}
                form_data.sender_number_id = this.form_data['sender_number_id'].id

                let form = new Form(form_data)

                form['post']('getBalance')
                    .then(function (response) {

                        this.panel_charge = response.charge
                    }.bind(this))
                    .catch(function (error) {
                        flash('خطا در نمایش شارژ', 'error')

                    });
            }
        },
    },

    created() {

        EventBus.$on("setContactNumberId", (id) => {

            const index = this.list.indexOf(id);
            if (!(index > -1)) {
                this.list.push(id);
                EventBus.$emit('contactNumbersSelectionList', this.list);
            }

        });

        EventBus.$on("unsetContactNumberId", (id) => {

            const index = this.list.indexOf(id);
            if (index > -1) { // only splice array when item is found
                this.list.splice(index, 1); // 2nd parameter means remove one item only
                EventBus.$emit('contactNumbersSelectionList', this.list);
            }
        });
    },
    watch: {
        'form_data.sender_number_id': {
            handler: function (v) {
                this.getBalancePanel()
            },
            deep: true
        }
    },
}
</script>
