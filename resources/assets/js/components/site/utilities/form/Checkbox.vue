<template>
    <div class="md:flex md:items-center mb-6">
        <div class="flex items-center">
          <input 
            type="checkbox" 
            :name="name" 
            :id="name" 
            class="h-6 ml-2 w-6 cursor-pointer" 
            v-model="checkbox_value"
            :disabled="is_disabled"
          />
          <label class="block leading-tight text-purple-darkest cursor-pointer" :for="name">
            {{ title }}
          </label>
          <div v-if="form.errors.has(name)" class="invisible">.</div>
        </div>
        <div class="text-pink" v-if="form.errors.has(name)" v-text="form.errors.get(name)"></div>
        
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