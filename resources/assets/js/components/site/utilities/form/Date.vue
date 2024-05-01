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
            :format="current_format"
            :display-format="current_display_format"
            color="#3490dc"
            :editable="true"
            :disabled="is_disabled"
            :type="current_type"
          ></date-picker>

          <div class="text-pink" v-if="form.errors.has(name)" v-text="form.errors.get(name)"></div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['form', 'form_data', 'name', 'title', 'is_disabled', 'value', 'display_format', 'format', 'type'],
        created(){
          // this.form_data[this.name] = this.value
          this.$set(this.form_data, this.name, this.value)
        },
        computed: {
          current_display_format(){
            if (typeof(this.display_format) != 'undefined') {
              return this.display_format;
            }
            return 'dddd jDD jMMMM jYYYY';
          },
          current_format(){
            if (typeof(this.format) != 'undefined') {
              return this.format;
            }
            return 'YYYY-MM-DD HH:mm:ss';
          },
          current_type(){
            if (typeof(this.type) != 'undefined') {
              return this.type;
            }
            return 'datetime';
          }
        }
    }
</script>