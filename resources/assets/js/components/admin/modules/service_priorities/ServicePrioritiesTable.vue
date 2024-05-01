<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

// Vue.component('service-priority-custom-actions', require('./CustomActions').default)
Vue.component('service-priority-detail', require('./DetailRow').default)

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../global_templates/table.html'),

  components:{
    'filter-bar': FilterBar,
  },
  
  data () {
    return {
      field_defs: this.localize(FieldDefs),
      apiUri: '/services/service_priorities',
      detailComponentName: 'service-priority-detail',
      sortOrder: [
        {
          sortField: 'code',
          direction: 'asc'
        }
      ],
    }
  },

}

</script>
