<template>
    <div class="md:flex md:items-center mb-2 opacity-50 hover-full-opacity">
        <div class="md:w-1/2">
          <label class="block text-grey-dark md:text-right mb-1 md:mb-0" :for="name">
            {{ title }} :
          </label>
          <div v-if="form.errors.has(name)" class="invisible">.</div>
        </div>
        <div class="md:w-1/2 text-left">
          <div class="form-switch inline-block align-middle">
            <input 
              type="checkbox" 
              :name="name" 
              :id="name" 
              class="form-switch-checkbox" 
              v-model="form_data[name]"
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
    }
</script>