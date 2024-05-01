<template>
    <div class="w-full md:flex md:items-center lg:w-1/2 px-2 mb-4">
      <div class="md:w-1/4">
        <label class="control-label" :for="name">
          {{ title }}
        </label>
        <div v-if="form_errors.has(name)" class="invisible">.</div>
      </div>

      <div class="md:w-3/4">

        <input 
          class="rhc-form-control" 
          autocomplete=off
          type="text" 
          :id="name" 
          v-model="form_data[name]" 
          :placeholder="title" 
          @keyup.enter="doFilter" 
          @keydown="form_errors.clear('name')"
        >

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
        props: ['form_errors', 'form_data', 'name', 'title', 'type', 'validate', 'value'],

        mixins: [FilterFormInputsMixin],
    }
</script>