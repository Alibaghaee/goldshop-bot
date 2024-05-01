<template>
  <div class="w-full">
      <div class="flex items-center justify-between font-bold bg-grey-light w-full flex px-4 py-1 mb-4 rounded" :class="allSelected ? 'bg-indigo-dark text-white' : ''">
        <div v-text="controller.title"></div>
        <b-form-checkbox v-model="allSelected"
                         :indeterminate="indeterminate"
                         @change="toggleAll"
                         class="pretty"
                         style="margin-top:0; margin-bottom: 0;"
         >
          {{ allSelected ? 'انتخاب همه' : 'انتخاب همه' }}
         </b-form-checkbox>
      </div>
      <b-form-checkbox-group id=""
                             stacked
                             v-model="selected"
                             name=""
                             :options="flavours"
                             class="flex flex-wrap mb-4"
        ></b-form-checkbox-group>
    <p>
      <!-- Selected: <strong>{{ selected }}</strong><br> -->
    </p>
  </div>
</template>

<script>
export default {
  props: ['controller','activeActions'],
  data () {
    return {
      flavours: this.controller.actions,
      selected: this.activeActions,
      allSelected: false,
      indeterminate: false
    }
  },

  created (){
    let values = _.map(this.flavours, 'value')
    this.selected = _.difference(this.activeActions, _.difference(this.activeActions, values))
  },

  methods: {
    toggleAll (checked) {
      this.selected = checked ? _.map(this.flavours, 'value') : []
    }
  },
  watch: {
    selected (newVal, oldVal) {
      // Handle changes in individual flavour checkboxes
      if (newVal.length === 0) {
        this.indeterminate = false
        this.allSelected = false
      } else if (newVal.length === this.flavours.length) {
        this.indeterminate = false
        this.allSelected = true
      } else {
        this.indeterminate = true
        this.allSelected = false
      }

      this.$emit('select', this.controller.id, this.selected);
    }
  }
}
</script>

