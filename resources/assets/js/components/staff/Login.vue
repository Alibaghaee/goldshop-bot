<template>
  <form id="staff-login" class="text-sm" @submit.prevent="onFormSubmit(endpoint)"
        @keydown="form.errors.clear($event.target.name)">

    <input
        class="p-6 py-2 md:py-3 rounded-full w-4/5 md:w-1/2 bg-transparent text-grey-lighter border-2 border-grey-lightest leading-normal outline-none"
        autocomplete=off
        type="text"
        name="username"
        id="username"
        :placeholder="$t('username')"
        v-model="form_data.username"
    >
    <div class="ml-6 mt-1">{{ vErrors.first('username') }}</div>
    <div class="ml-6 mt-1" v-if="form.errors.has('username')" v-text="form.errors.get('username')"></div>

    <input
        class="p-6 py-2 md:py-3 rounded-full w-4/5 md:w-1/2 bg-transparent text-grey-lighter border-2 border-grey-lightest mt-4 leading-normal outline-none"
        autocomplete=off
        type="password"
        name="password"
        id="password"
        :placeholder="$t('Password')"
        v-model="form_data.password"
    >
    <div class="ml-6 mt-1">{{ vErrors.first('password') }}</div>
    <div class="ml-6 mt-1" v-if="form.errors.has('password')" v-text="form.errors.get('password')"></div>

    <div class="Checkbox mt-6">
      <input id="accept" type="checkbox" class="Checkbox-input flex-none" v-model="form_data.accept">
      <span class="Checkbox-label"
      >
            {{ $t('I have read the') }}
            <a :href="privacy_policy_url" class="text-white hover:text-grey-light">{{ $t('Privacy Policy') }}</a>
            {{ $t('and accept them.') }}
          </span>
    </div>
    <div class="ml-6 mt-1">{{ vErrors.first('accept') }}</div>
    <div class="ml-6 mt-1" v-if="form.errors.has('accept')" v-text="form.errors.get('accept')"></div>

    <div class="mt-24 mb-4 flex">
      <button
          class="text-sm bg-indigo-dark block no-undeline no-underline p-3 rounded-full text-center text-white w-48 md:w-64 hover:bg-white hover:text-indigo-dark mr-3 outline-none font-medium"
          type="submit">{{ $t('Login') }}
      </button>
    </div>
  </form>
</template>

<script>
import {Form, FormErrors} from './../../form.js';

export default {
  props: ['action', 'privacy_policy_url'],
  data() {
    return {
      endpoint: this.action,
      form_data: {
        'username': '',
        'password': ''
      },
      form: new Form(this.form_data),
      method: 'post'
    }
  },
  methods: {
    // callFlutterHandler(response) {
    //
    //   window.addEventListener("flutterInAppWebViewPlatformReady", function (event) {
    //     const args = [
    //       {'ACCESS_TOKENS': response.tokens},
    //     ];
    //     window.flutter_inappwebview.callHandler('accessTokenWebLine', ...args);
    //   });
    //
    //
    // },
    onFormSubmit(endpoint) {
      this.form = new Form(this.form_data)
      this.form[this.method](endpoint)
          .then(
              (response) => {

              })
    }

  }
}
</script>
