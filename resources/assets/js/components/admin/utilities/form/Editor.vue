<template>
    <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/4">
          <label class="block text-grey-dark md:text-right mb-1 md:mb-0 pr-4" :for="name">
            {{ title }} :
          </label>
          <div v-if="form.errors.has(name)" class="invisible">.</div>
        </div>
        <div class="md:w-3-4 bg-grey-lighter md:w-2/3 p-2 rounded">
          <editor
          :name="name" 
          :id="name" 
          cols="30"
          rows="20" 
          class="rhc-form-control" 
          :placeholder="title" 
          v-model="form_data[name]" 
          v-text="form_data[name]"
          :disabled="is_disabled"
          :init="{plugins: ['wordcount', 'code']}"
          ></editor>
          <div class="text-pink" v-if="form.errors.has(name)" v-text="form.errors.get(name)"></div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['form', 'form_data', 'name', 'title', 'value', 'is_disabled'],
        created(){
          // this.form_data[this.name] = this.value
          this.$set(this.form_data, this.name, this.value)
        }
    }
</script>