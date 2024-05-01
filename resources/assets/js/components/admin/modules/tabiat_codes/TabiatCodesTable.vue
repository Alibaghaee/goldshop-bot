<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

Vue.component('tabiat-code-custom-actions', require('./CustomActions'))
Vue.component('tabiat-code-detail', require('./DetailRow'))

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../global_templates/table.html'),

  components:{
    'filter-bar': FilterBar,
  },
  
  data () {
    return {
      field_defs: FieldDefs,
      apiUri: '/tabiat_codes/tabiat_codes',
      detailComponentName: 'tabiat-code-detail',
      sortOrder: [
        {
          sortField: '_id',
          direction: 'desc'
        }
      ],
    }
  },

}

</script>
