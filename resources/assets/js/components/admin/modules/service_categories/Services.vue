<template>
  <div class="w-full">
    
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
  props: ['service','activeItems'],
  data () {
    return {
      flavours: this.service,
      selected: this.activeItems,
      allSelected: false,
      indeterminate: false
    }
  },

  created (){
    let values = _.map(this.flavours, 'value')
    this.selected = _.difference(this.activeItems, _.difference(this.activeItems, values))
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

      this.$emit('select', this.service.id, this.selected);
    }
  }
}
</script>

