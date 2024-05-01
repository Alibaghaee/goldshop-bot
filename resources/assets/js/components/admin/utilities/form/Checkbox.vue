<template>
    <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/4">
          <label class="block text-grey-dark md:text-right mb-1 md:mb-0 pr-4" :for="name">
            {{ title }} :
          </label>
          <div v-if="form.errors.has(name)" class="invisible">.</div>
        </div>
        <div class="md:w-2/3">
          <div class="form-switch inline-block align-middle">
            <input 
              type="checkbox" 
              :name="name" 
              :id="name" 
              class="form-switch-checkbox" 
              v-model="checkbox_value"
              :disabled="is_disabled"
            />
            <label class="form-switch-label" :for="name"></label>
          </div>
          <!-- <b-form-checkbox v-model="form_data[name]" @change="" class="pretty"></b-form-checkbox> -->
          <div class="text-pink" v-if="form.errors.has(name)" v-text="form.errors.get(name)"></div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['form', 'form_data', 'name', 'title', 'is_disabled', 'value'],
        data () {
          return {
            checkbox_value: this.value
          }
        },
        created () {
            // this.form_data[this.name] = this.value;
            this.$set(this.form_data, this.name, this.value)
        },
        watch : {
          checkbox_value (val){
            this.form_data[this.name] = val;
          }
        },
    }
</script>