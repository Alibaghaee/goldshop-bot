<template>
    <div class="w-full">
        <div class="rhc-title pt-4" v-if="page_title">
            <svg v-if="method == 'post'" xmlns="http://www.w3.org/2000/svg" class="fill-current w-6 h-6 ml-2" viewBox="0 0 512 512"><path d="M448 224H288V64h-64v160H64v64h160v160h64V288h160z"/></svg>
            <svg v-else class="fill-current w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 451.44500732421875 451.44500732421875"><path d="M131 411.018l-90.569-90.569L290.78 70.101l90.57 90.569zm308.723-351.18l-48.115-48.114C379.885 0 360.05.828 347.304 13.574l-45.202 45.203 90.569 90.568 45.202-45.202c12.743-12.746 13.572-32.582 1.85-44.305zM32.021 334.697L0 451.445l116.737-32.021z"></path></svg>
            <div v-text="page_title"></div>
        </div>

        <div class="flex flex-row flex-wrap">
            <div class="w-full md:w-1/2">
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

            <div class="w-full md:w-1/2">
                <slot name="left" :form="form" :form_data="form_data">

                </slot>
            </div>
        </div>

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