<template>
    <div class="w-full md:flex md:items-center lg:w-1/2 px-2 mb-4">
      <div class="md:w-1/4">
        <label class="control-label" :for="name">
          {{ title }}
        </label>
        <div v-if="form_errors.has(name)" class="invisible">.</div>
      </div>

      <div class="md:w-3/4">

        <date-picker 
          :id="name"
          v-model="form_data[name]" 
          @input="doFilter"
          format="YYYY-MM-DD"
          display-format="jYYYY/jMM/jDD"
          color="#3490dc"
          :editable="true"
          :auto-submit="true"
        ></date-picker>        

        <div 
          class="text-pink" 
          v-if="form_errors.has(name)" 
          v-text="form_errors.get(name)"
        ></div>

      </div>
    </div>
</template>

<script>
    import FilterFormInputsMixin from './../../mixins/FilterFormInputsMixin'

    export default {
        props: ['form_errors', 'form_data', 'name', 'title', 'value'],

        mixins: [FilterFormInputsMixin],

        created(){
          // this.form_data[this.name] = this.value ? this.value : null;
          this.$set(this.form_data, this.name, this.value)
        },
    }
</script>