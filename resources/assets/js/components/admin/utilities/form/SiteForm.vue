<template>
    <div class="w-full">
        <form class="max-w-md" @submit.prevent="onFormSubmit(endpoint)" @keydown="form.errors.clear($event.target.name)">

            <slot name="controls" :form="form" :form_data="form_data">
                <!-- default input if not replace with something else -->
                <i-text :form="form" :form_data="form_data" name="title" title="عنوان"></i-text>
            </slot>

            <div class="md:flex md:items-center">
              <div class="md:w-1/4"></div>
              <div class="md:w-2/3">
                <slot name="submit">
                    <!-- default submit button if not replace with something else -->
                    <button class="mb-2 rhc-btn rhc-btn-teal" type="submit">
                        <span v-if="submit_text" v-text="submit_text"></span>
                        <span v-else>تایید</span>
                    </button>
                </slot>
              </div>
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