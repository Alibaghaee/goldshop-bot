<template>
  <form class="text-sm" @submit.prevent="onFormSubmit(endpoint)" @keydown="form.errors.clear($event.target.name)">

    <input
        class="p-6 py-3 rounded-full w-full md:w-1/2 bg-transparent text-grey-lighter border-2 border-grey-lightest leading-normal outline-none"
        autocomplete=off
        type="text"
        name="code"
        id="code"
        :placeholder="$t('Code')"
        v-model="form_data.code"
    >
    <!--    <div class="ml-6 mt-1">{{ vErrors.first('code') }}</div>-->
    <!--    <div class="ml-6 mt-1" v-if="form.errors.has('code')" v-text="form.errors.get('code')"></div>-->


    <div class="ml-6 mt-1">{{ $t(errorMessage) }}</div>


    <div class="mt-24 mb-4 flex">
      <button
          class="text-sm bg-indigo-dark block no-undeline no-underline p-3 rounded-full text-center text-white w-64 hover:bg-white hover:text-indigo-dark mr-3 outline-none"
          type="submit">{{ $t('Next') }}
      </button>
    </div>

  </form>


</template>

<script>
import {Form, FormErrors} from './../../form.js';

export default {
  props: ['action'],
  data() {

    return {
      endpoint: this.action,
      form_data: {
        'code': '',
      },

      errorMessage: '',
      form: new Form(this.form_data),

      method: 'post'
    }
  },
  methods: {

    onFormSubmit(endpoint) {
      this.form = new Form(this.form_data)
      this.form[this.method](endpoint)
          .then(function (response) {

            this.errorMessage = ''
            window.location.href = response.data.redirect
          }.bind(this))
          .catch(function (error) {

            this.errorMessage = 'hospital_not_found'
          }.bind(this));
    }
  }
}
</script>
