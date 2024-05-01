<template>
    <div class="md:flex md:items-center mb-6" v-show="type != 'hidden'">
        <div class="md:w-1/4">
          <label class="block text-grey-dark md:text-right mb-1 md:mb-0 pr-4" :for="name">
            {{ title }} :
          </label>
          <div v-if="form.errors.has(name)" class="invisible">.</div>
        </div>
        <div class="md:w-2/3">
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
          >
          <span class="text-pink">{{ vErrors.first(name) }}</span>
          <div class="text-pink" v-if="form.errors.has(name)" v-text="form.errors.get(name)"></div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['form', 'form_data', 'name', 'title', 'type', 'validate', 'value', 'is_disabled'],
        created(){
          // this.form_data[this.name] = this.value
          this.$set(this.form_data, this.name, this.value)
        }
    }
</script>