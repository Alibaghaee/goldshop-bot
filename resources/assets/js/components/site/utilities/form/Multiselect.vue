<template>
    <div class="md:flex md:items-center mb-4">
        <!-- <div class="md:w-1/4">
          <label class="block text-grey-dark md:text-right mb-1 md:mb-0 pr-4" :for="name">
            {{ title }} :
          </label>
          <div v-if="form.errors.has(name + '.id')" class="invisible">.</div>
        </div> -->
        <div class="w-full">

          <multiselect 
          v-model="multiselect_value" 
          :close-on-select="true" 
          track-by="name" 
          label="name"
          :options="options" 
          :searchable="true" 
          dir="rtl"
          :id="name"
          @select=""
          :disabled="is_disabled"
          :group-label="group_label"
          :group-values="group_values"
          :placeholder="'' + title"
          >
          </multiselect>
          
          <div class="text-pink" v-if="form.errors.has(name + '.id')" v-text="form.errors.get(name + '.id')"></div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['form', 'form_data', 'name', 'title', 'options', 'value', 'is_disabled', 'group_values', 'group_label'],
        data () {
          return {
            multiselect_value: this.value
          }
        },
        created () {
            // this.form_data[this.name] = this.value;
            this.$set(this.form_data, this.name, this.value)
        },
        watch : {
          multiselect_value (val){
            this.form_data[this.name] = val;
          }
        },
    }
</script>