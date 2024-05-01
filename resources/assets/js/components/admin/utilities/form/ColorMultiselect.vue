<template>
    <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/4">
          <label class="block text-grey-dark md:text-right mb-1 md:mb-0 pr-4" :for="name">
            {{ $t(title) }} :
          </label>
          <div v-if="form.errors.has(name + '.id')" class="invisible">.</div>
        </div>
        <div class="md:w-2/3">

          <multiselect 
          v-model="form_data[name]" 
          :close-on-select="close_on_select" 
          :track-by="track_by" 
          :label="label"
          :options="options" 
          :searchable="searchable" 
          dir=""
          :id="name"
          @select=""
          :disabled="is_disabled"
          :group-label="group_label"
          :group-values="group_values"
          :group-select="group_select"
          :multiple="multiple"
          :placeholder="$t('select')"
          >
              <template slot="singleLabel" slot-scope="props">
                <div class="flex items-center">
                  <div class="w-8 h-4 rounded-full mr-2" :style="'background-color: ' + props.option.color"></div>
                  <span class="option__desc">
                    <span class="option__title">{{ props.option.name }}</span>
                  </span>
                </div>
              </template>
              <template slot="option" slot-scope="props">
                <div class="flex flex-wrap items-center">
                  <div class="w-8 h-4 rounded-full mr-2" :style="'background-color: ' + props.option.color"></div>
                  <div class="option__desc">
                    <span class="option__title">{{ props.option.name }}</span>
                  </div>
                </div>
              </template>

          </multiselect>
          
          <div class="text-pink" v-if="form.errors.has(name + '.id')" v-text="form.errors.get(name + '.id')"></div>
        </div>
    </div>
</template>

<script>
    export default {
        // props: ['form', 'form_data', 'name', 'title', 'options', 'value', 'is_disabled', 'group_values', 'group_label', 'multiple'],
        props: {
          form: Object,
          form_data: Object,
          name: String,
          title: String,
          options: Array,
          value: Array|Object,
          is_disabled: Boolean,
          track_by: {
            type: String,
            default: 'id'
          },
          label: {
            type: String,
            default: 'name'
          },
          group_values: String,
          group_label: String,
          multiple: {
            type: Boolean,
            default: false
          },
          group_select: {
            type: Boolean,
            default: false
          },
          close_on_select:{
            type: Boolean,
            default: true
          },
          searchable:{
            type: Boolean,
            default: true
          }
        },
        created () {
            this.$set(this.form_data, this.name, this.value)
        },
        watch : {
          value (val){
            this.form_data[this.name] = val;
          }
        },
    }
</script>