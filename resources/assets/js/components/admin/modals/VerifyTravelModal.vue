<template>
    <modal name="verify-travel" :width="450" :height="470" :adaptive="true">
        <div class="flex h-full flex-wrap">
            <form class="flex flex-col flex-wrap justify-between m-8 max-w-md w-full"
                  @submit.prevent="onFormSubmit()">

                <div v-if="data">
                    <i-multiselect
                        :form="form"
                        :form_data="form_data"
                        name="driver_id"
                        title="راننده"
                        :options="drivers"
                    ></i-multiselect>
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
    drivers:[],

    data() {
        return {
            endpoint: '/travels/travels/verify/',
            form_data: {},
            form: new Form(this.form_data),

            data: '',


        }
    },
    methods: {
        callDrivers(){

            // window.axios.get('/drivers/drivers/index-as-option/')
            //     .then(function (response) {
            //
            //         this.drivers=response.data
            //     }.bind(this))
            //     .catch(function (error) {
            //         flash('خطا در عملیات تایید', 'error')
            //     });
        },
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
            this.$modal.hide('verify-travel')
        },
        showDialog(data) {
            this.data = data.data.data
            this.list = this.data.list
            this.$modal.show('verify-travel')

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
        window.events.$on('verifyTravelModal', data => this.showDialog(data));
        this.use_new_list_parts = false;
        this.callDrivers();
    },
    watch: {
        list(val) {
            this.form_data['list'] = val;
        },
    },
}

</script>
