<template>
    <div class="w-full md:flex md:items-center lg:w-1/2 px-2 mb-4">
      <div class="md:w-1/4">
        <label class="control-label" :for="name">
          {{ title }}
        </label>
        <div v-if="form_errors.has(name + '.id')" class="invisible">.</div>
      </div>

      <div class="md:w-3/4">

        <multiselect 
          v-model="form_data[name]" 
          :close-on-select="true" 
          track-by="name" 
          label="name"
          :options="options" 
          :searchable="true" 
          dir="rtl"
          :id="name"
          @select="doFilter"
          :group-label="group_label"
          :group-values="group_values"
        ></multiselect>

        <div 
          class="text-pink" 
          v-if="form_errors.has(name + '.id')" 
          v-text="form_errors.get(name + '.id')"
        ></div>

      </div>
    </div>
</template>

<script>
    import FilterFormInputsMixin from './../../mixins/FilterFormInputsMixin'

    export default {
        props: ['form_errors', 'form_data', 'name', 'title', 'options', 'group_values', 'group_label', 'value'],

        created(){
          if (typeof(this.value) != 'undefined') {
            this.form_data[this.name] = JSON.parse(this.value);
          }
        },

        methods: {
          doFilter () {
            this.$events.fire('filter-set', this.form_data)
            window.events.$emit('filter-set-for-report', this.form_data)
          },
        }
    }
</script>