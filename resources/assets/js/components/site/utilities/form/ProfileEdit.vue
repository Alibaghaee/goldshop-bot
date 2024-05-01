<template>
    <div class="w-full mb-auto">

        <form class="" @submit.prevent="onFormSubmit()" @keydown="form.errors.clear($event.target.name)">

            <div class="flex flex-wrap -mx-2">

                <slot name="controls" :form="form" :form_data="form_data">
                </slot>

            </div>

            <div class="flex justify-center m-4" v-if="loading">
                <div class="lds-default"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            </div>

            <div class="md:flex md:items-center mt-6" v-if="!loading">
              <div class="w-full flex flex-wrap">
                <slot name="submit">
                    <!-- default submit button if not replace with something else -->
                    <button class="bg-purple hover:bg-purple-dark rounded py-2 px-6 text-white cursor-pointer h-12 text-center block mx-auto w-32" type="submit">
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
        props: ['action', 'method', 'page_title', 'submit_text', 'provinces', 'cities', 'profile'],
        data () {
            return {
                endpoint: this.action,
                form_data: {},
                form: new Form(this.form_data),
                loading: false
            }
        },
        methods: {
            onFormSubmit(endpoint){
                this.loading = true
                this.form = new Form(this.form_data)
                this.form[this.method](this.endpoint)
                    .then(function(response){
                        this.loading = false
                    }.bind(this))
                    .catch(function(){
                        this.loading = false
                    }.bind(this));
            },
            
        }
    }
</script>