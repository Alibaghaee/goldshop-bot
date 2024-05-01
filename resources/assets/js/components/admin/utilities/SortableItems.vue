<template>
    <div class="w-full">
        <draggable v-model="form_data.items_data">
            <transition-group>
                <div 
                    v-for="(element, index) in form_data.items_data" 
                    :key="index"
                    v-text="element.title"
                    class="bg-grey-lighter border-r-8 border-solid border-teal cursor-move mb-2 px-4 py-2 rounded"
                >  
                </div>
            </transition-group>
        </draggable>

        <button type="button" class="mb-2 rhc-btn rhc-btn-teal" @click="onSubmit">تایید</button>

    </div>

</template>

<script>
    import draggable from './../../../components/admin/utilities/vuedraggable.js';
    import { Form, FormErrors } from './../../../form.js';

    export default {
        props: ['items', 'endpoint_uri'],
        components: {
            draggable,
        },
        data (){
            return {
                endpoint: this.endpoint_uri,
                method: 'post',
                form_data: {
                    'items_data' : this.items
                },
                form: new Form(this.form_data),
            }
        },
        methods: {
            onSubmit (){
                this.form = new Form(this.form_data);
                this.form[this.method](this.endpoint);
            }
        }
    }
</script>