<template>
    <modal name="location-sender" :width="450" :height="470" :adaptive="true">
        <div class="flex h-full flex-wrap">
            <form class="flex flex-col flex-wrap justify-between m-8 max-w-md w-full" @submit.prevent="onFormSubmit()">

                <div v-if="data">



                <div class="text-center">  شماره های موبایل را با کاما
                    <span class="text-blue">(",")</span> از هم جدا کنید.</div>
              <textarea
                  v-model="list"
                  name="list"

                  class="rhc-form-control leading-loose overflow-y-auto text-grey-dark text-sm"
                  style="height: 145px;"

              ></textarea>
                </div>

                <button class="rhc-btn rhc-btn-green w-full" type="submit">
                    <span>ارسال</span>
                </button>
            </form>
        </div>

    </modal>
</template>

<script>

import {Form, FormErrors} from './../../../form.js';

export default {

    data() {
        return {
            endpoint: '/maps/maps/send_location/',
            form_data: {},
            form: new Form(this.form_data),

            data: '',
            list: '',

        }
    },
    methods: {
        onFormSubmit() {
            this.form = new Form(this.form_data)
            this.form['put'](this.endpoint + this.data.id)
                .then(function (response) {
                    this.handleresponse(response);
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
            this.$modal.hide('location-sender')
        },
        showDialog(data) {
            this.data = data.data.data
            this.list = this.data.list
            this.$modal.show('location-sender')
        },

    },
    computed: {

        sendTypeLable() {
            if (this.data.blacklist_type === 0) {
                return '<div class="p-1 px-2 rounded text-grey-darkest bg-yellow-dark">پیامکی</div>';
            }
            if (this.data.blacklist_type === 1) {
                return '<div class="bg-purple-light p-1 px-2 rounded text-white">صوتی</div>';
            }
        },

    },
    created() {

        window.events.$on('locationSenderModal', data => this.showDialog(data));
        this.use_new_list_parts = false;
    },
    watch: {

        list(val) {
            this.form_data['list'] = val;
        },

    },
}

</script>
