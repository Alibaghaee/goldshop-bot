<template>
  <div class="mb-6" v-show="type != 'hidden'">
    <div class="md:flex md:items-center">
        <div class="md:w-1/4 flex md:justify-end">
          <label class="block text-grey-dark md:text-right mb-1 md:mb-0 pr-4" :for="name">
            {{ $t(title) }} :
          </label>
          <div v-if="form.errors.has(name)" class="invisible absolute">.</div>
        </div>
        <div class="md:w-2/3">
          <input 
            class="rhc-form-control" 
            autocomplete=off
            :type="type" 
            v-validate="validate" 
            :name="name" 
            :id="name" 
            :placeholder="$t(title)" 
            v-model="form_data[name]"
            :disabled="is_disabled"
          >
        </div>
    </div>

    <div class="md:flex md:items-center">
        <div class="md:w-1/4"></div>
        <div class="md:w-2/3">
          <div class="text-grey text-sm" v-if="help && !form.errors.has(name)">{{ help }}</div>
          <div class="text-pink">{{ vErrors.first(name) }}</div>
          <div class="text-pink" v-if="form.errors.has(name)" v-text="form.errors.get(name)"></div>
        </div>
    </div>
  </div>
</template>

<script>
    export default {
        props: ['form', 'form_data', 'name', 'title', 'type', 'validate', 'value', 'is_disabled', 'help', 'values', 'active_locale'],
        created(){
          this.$set(this.form_data, this.name, this.value)
        },
        watch: {
          active_locale(locale){
            this.$set(this.form_data, this.name, this.values[locale.key])
          }
        }
    }
</script>