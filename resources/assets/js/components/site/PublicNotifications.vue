<template>

    <a :href="publicNotification.link" v-if="publicNotification.link" v-html="publicNotification.description"> </a>
    <p class="" v-else v-html="publicNotification.description"></p>
</template>

<script>
import {Form, FormErrors} from './../../form.js';

export default {
    props: ['public_notifications'],

    data() {

        return {
            publicNotification: '',
            loading: false,
            form_data: {},
            form: new Form(this.form_data),
        }
    },
    methods: {
        sleep(milliseconds) {
            return new Promise((resolve) => setTimeout(resolve, milliseconds));
        },
        async playQuote() {

            for (let i = 0; i < this.public_notifications.items.length; i++) {
                await this.sleep(4000);
                this.publicNotification = this.public_notifications.items[i];

                if (i === this.public_notifications.items.length - 1) {
                    i = -1
                }
            }
        },
    },
    created() {

        this.playQuote()
    }
}
</script>
