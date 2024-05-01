<template>
    <div class="mt-10">
        <div class="flex h-full flex-wrap">
            <form class="flex flex-col flex-wrap justify-between m-8  w-full   rounded border-2 p-2"
                  @submit.prevent="onFormSubmit()">
                <div class="flex ">
                    <div class="text-blue py-2">پیام خود را در کادر زیر بنویسید.</div>

                    <div class="mr-5"></div>
                    <div class="text-blue py-2 mr-2 ">تعداد کاربران انتخاب شده :
                        <div class="inline text-blue font-bold">
                            {{ list.length }}
                        </div>
                    </div>
                    <div class="rhc-btn rhc-btn-pink m-2 " v-on:click="unselectAllUser">بازنشانی</div>
                    <div class="rhc-btn rhc-btn-blue m-2" v-on:click="selectAllUser">انتخاب صفحه</div>
                </div>


                <div>
                    <textarea
                        v-model="message"
                        name="message"

                        class="rhc-form-control leading-loose overflow-y-auto text-grey-dark text-sm"
                        style="height: 145px;"

                    ></textarea>

                </div>

                <button class="rhc-btn rhc-btn-green w-full" type="submit">
                    <span>ارسال</span>
                </button>
            </form>
        </div>

    </div>
</template>

<script>

import {Form} from "../../../../../form";
import {EventBus} from "../../../../../event-bus";

export default {
    props: ['action_url'],
    data() {
        return {
            endpoint: '/news_letters/news_letters',
            form_data: {},
            form: new Form(this.form_data),

            data: '',
            message: '',
            list: [],

        }
    },
    methods: {
        onFormSubmit() {

            this.form_data.message = this.message;
            this.form_data.user_ids = JSON.stringify(this.list);

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

        selectAllUser(event) {

            EventBus.$emit('usersSelectionCond', 'selected_all');
        },
        unselectAllUser(event) {

            EventBus.$emit('usersSelectionCond', 'unselected_all');
        },
    },

    created() {

        EventBus.$on("setUserId", (id) => {

            const index = this.list.indexOf(id);
            if (!(index > -1)) {
                this.list.push(id);
                EventBus.$emit('usersSelectionList', this.list);
            }

        });

        EventBus.$on("unsetUserId", (id) => {

            const index = this.list.indexOf(id);
            if (index > -1) { // only splice array when item is found
                this.list.splice(index, 1); // 2nd parameter means remove one item only
                EventBus.$emit('usersSelectionList', this.list);
            }
        });
    },
}
</script>
