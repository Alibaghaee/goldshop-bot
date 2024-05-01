<template>
    <div class="md:flex md:items-center mb-4" v-show="type != 'hidden'">
        <!-- <div class="md:w-1/4">
          <label class="block text-grey-dark md:text-right mb-1 md:mb-0 pr-4" :for="name">
            {{ title }} :
          </label>
          <div v-if="form.errors.has(name)" class="invisible">.</div>
        </div> -->
        <div class="w-full relative">
          <input 
            class="rhc-form-control" 
            autocomplete=off
            :type="type" 
            v-validate="validate" 
            :name="name" 
            :id="name" 
            :placeholder="title" 
            v-model="form_data[name]"
            :disabled="is_disabled"
            @keyup="checkPostalCode()"
          >
          <span class="text-pink">{{ vErrors.first(name) }}</span>
          <div class="text-pink" v-if="form.errors.has(name)" v-text="form.errors.get(name)"></div>

          <div class="absolute pin-t pin-l py-1 pl-2" v-if="loading">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgba(255, 255, 255, 0); display: block; shape-rendering: auto;" width="40px" height="40px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                <circle cx="50" cy="50" fill="none" stroke="#0687ff" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
                  <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                </circle>
              </svg>
          </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['form', 'form_data', 'name', 'title', 'type', 'validate', 'value', 'is_disabled'],

        data(){
          return {
            loading: false
          }
        },
        methods: {
          checkPostalCode(){
            if (this.form_data.postal_code.length == 10) {
              this.loading = true
              axios['post']('/fa/postal_code', {'postal_code' : this.form_data.postal_code})
              .then(response => {
                console.log(response.data)
                this.form_data['address'] = response.data
                this.loading = false
              })
            }
          }
        },
        created(){
          this.$set(this.form_data, this.name, this.value)
        }
    }
</script>