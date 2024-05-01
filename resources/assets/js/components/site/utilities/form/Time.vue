<template>
    <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/4">
          <label class="block text-grey-dark md:text-right mb-1 md:mb-0 pr-4" :for="name">
            {{ title }} :
          </label>
          <div v-if="form.errors.has(name)" class="invisible">.</div>
        </div>
        <div class="md:w-2/3">

          <date-picker 
            :id="name"
            v-model="form_data[name]" 
            @input=""
            color="#3490dc"
            :editable="true"
            :disabled="is_disabled"
            type="time"
          ></date-picker>

          <div class="text-pink" v-if="form.errors.has(name)" v-text="form.errors.get(name)"></div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['form', 'form_data', 'name', 'title', 'is_disabled', 'value'],
        created(){
          // this.form_data[this.name] = this.value
          this.$set(this.form_data, this.name, this.value)
        },
    }
</script>