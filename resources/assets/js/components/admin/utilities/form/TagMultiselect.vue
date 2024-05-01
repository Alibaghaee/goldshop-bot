<template>
    <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/4">
          <label class="block text-grey-dark md:text-right mb-1 md:mb-0 pr-4" :for="name">
            {{ title }} :
          </label>
          <div v-if="form.errors.has(name + '.id')" class="invisible">.</div>
        </div>
        <div class="md:w-2/3">

          <multiselect 
          v-model="multiselect_value" 
          :close-on-select="false" 
          :clear-on-select="false"
          track-by="name" 
          label="name"
          :options="multiselect_options" 
          :searchable="true" 
          dir="rtl"
          :id="name"
          @select=""
          :disabled="is_disabled"
          :group-label="group_label"
          :group-values="group_values"
          :placeholder="placeholder"
          :tag-placeholder="tag_placeholder"
          :multiple="multiple"
          :taggable="taggable"
          @tag="addTag"
          >
          </multiselect>
          
          <div class="text-pink" v-if="form.errors.has(name + '.id')" v-text="form.errors.get(name + '.id')"></div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['form', 'form_data', 'name', 'title', 'options', 'value', 'is_disabled', 'group_values', 'group_label', 'placeholder', 'tag_placeholder', 'multiple', 'taggable'],
        data () {
          return {
            multiselect_value: this.value,
            multiselect_options: this.options
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
        methods: {
          addTag (newTag) {
            axios.post('/tags/tags', {
              title: newTag,
              type: 'multiselect',
            })
            .then(function(response){
              const tag = {
                name: newTag,
                id: response.data.id
              }
              this.multiselect_options.push(tag)
              this.form_data[this.name].push(tag)
            }.bind(this))
            .catch(function(){
              flash('خطا در اضافه کردن برچسب جدید', 'error')
            });

          }
        }
    }
</script>