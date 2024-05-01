<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

Vue.component('entity-trash-custom-actions', require('./CustomActions').default)
Vue.component('entity-trash-detail', require('./DetailRow').default)

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../global_templates/table.html'),

  components:{
    'filter-bar': FilterBar,
  },
  
  data () {
    return {
      field_defs: this.localize(FieldDefs),
      apiUri: '/entities/entities/trash',
      detailComponentName: 'entity-trash-detail',
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
