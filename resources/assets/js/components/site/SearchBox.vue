<template>
    <div class="my-4 relative text-center">
        <img class="w-10 absolute left-0 top-1" src="/image/site/Search.svg" alt="">
        <input
            v-model="form_data.search_box"
            name="search_box" class="w-full p-2 rounded-md transition-all duration-300 outline-none
        focus-visible:outline-none focus-visible:shadow-xl" placeholder="جستجو در سایت" type="text">

        <button
            @click="submit"
            :disabled="loading"
            :class=" [loading === true ?'bg-grey-darker buttonloading ':'bg-primary']"
            class="w-full cursor-pointer mt-2 inline-block  text-white p-2 rounded-lg border-2 border-primary">

            <span v-if="!loading">جستجو</span>
            <span v-else>درحال جستجو</span>
            <i class="fa fa-refresh fa-spin" v-if="loading"></i>
        </button>
    </div>
</template>

<script>
import {Form, FormErrors} from './../../form.js';

export default {


    data() {

        return {
            loading: false,
            form_data: {},
            form: new Form(this.form_data),
        }
    },
    methods: {
        submit() {

            this.loading = true
            this.form = new Form(this.form_data)


            axios.post('/fa/search', this.form_data)
                .then(function (response) {

                    this.loading = false

                    if (response.data.result === 'ok') {

                        // this.$router.push(response.data.path)
                        window.location.href = response.data.path;
                    } else {

                        flash('محتوایی یافت نشد!', 'error')
                    }

                }.bind(this))
                .catch(function (error) {
                    flash('خطا در در انجام عملیات', 'error')
                    this.loading = false
                }.bind(this))
        },
    }
}
</script>
