<template>
    <div class="w-full md:flex md:items-center lg:w-1/2 px-2 mb-4">
      <div class="md:w-1/4">
        <label class="control-label" :for="name">
          {{ title }}
        </label>
        <div v-if="form_errors.has(name)" class="invisible">.</div>
      </div>

      <div class="md:w-3/4">

        <div class="form-switch inline-block align-middle">
           <input type="checkbox" :name="name" :id="name" class="form-switch-checkbox"  v-model="form_data[name]"
           @change="doFilter"/>
           <label class="form-switch-label" :for="name"></label>
        </div>

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

        methods: {
          doFilter () {
            this.$events.fire('filter-set', this.form_data)
            window.events.$emit('filter-set-for-report', this.form_data)
          },
        }
    }
</script>