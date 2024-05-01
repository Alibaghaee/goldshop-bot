<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

Vue.component('notify-custom-actions', require('./CustomActions'))
Vue.component('notify-detail', require('./DetailRow'))

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../global_templates/table.html'),

  components:{
    'filter-bar': FilterBar,
  },
  
  data () {
    return {
      field_defs: FieldDefs,
      apiUri: '/notifies/notifies',
      detailComponentName: 'notify-detail',
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
