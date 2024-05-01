<template>
    <div class="w-full">

        <form class="" @submit.prevent="onFormSubmit(endpoint)" @keydown="form.errors.clear($event.target.name)">

            <slot name="controls" :form="form" :form_data="form_data">
                <!-- default input if not replace with something else -->
                <i-text :form="form" :form_data="form_data" name="title" title="عنوان"></i-text>
            </slot>

            <div class="text-pink leading-none text-sm my-4" v-if="form.errors.has('throttle')" v-text="form.errors.get('throttle')"></div>

            <div class="flex justify-end">
                <slot name="submit">
                    <!-- default submit button if not replace with something else -->
                    <button class="bg-teal hover:bg-teal-dark rounded py-2 px-6 text-white cursor-pointer h-12 w-32 text-center block" type="submit">
                        <span v-if="submit_text" v-text="submit_text"></span>
                        <span v-else>تایید</span>
                    </button>
                </slot>
            </div>
        </form>

    </div>
</template>

<script>
    import { Form, FormErrors } from './../../../../form.js';

    export default {
        props: ['action', 'method', 'page_title', 'submit_text'],
        data () {
            return {
                endpoint: this.action,
                form_data: {},
                form: new Form(this.form_data)
            }
        },
        methods: {
            onFormSubmit (endpoint){
                this.form = new Form(this.form_data)
                this.form[this.method](endpoint)
                    .then();
            }
        },
        watch: {
            form_data(val){
                // console.log(val);
            }
        }
    }
</script>
