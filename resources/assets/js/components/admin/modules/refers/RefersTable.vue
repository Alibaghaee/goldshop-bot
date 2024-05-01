<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

Vue.component('refer-custom-actions', require('./CustomActions'))
Vue.component('refer-detail', require('./DetailRow'))

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../global_templates/table.html'),

  components:{
    'filter-bar': FilterBar,
  },
  
  data () {
    return {
      field_defs: FieldDefs,
      apiUri: '/refers/refers',
      detailComponentName: 'refer-detail',
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
