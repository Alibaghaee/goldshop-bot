<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

// Vue.component('task-custom-actions', require('./CustomActions'))
Vue.component('task-detail', require('./DetailRow'))
Vue.component('task-report', require('./Report'))

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../global_templates/table.html'),

  components:{
    'filter-bar': FilterBar,
  },
  
  data () {
    return {
      field_defs: FieldDefs,
      apiUri: '/tasks/tasks',
      detailComponentName: 'task-detail',
      sortOrder: [
        {
          sortField: 'id',
          direction: 'desc'
        }
      ],
    }
  },

}

</script>
