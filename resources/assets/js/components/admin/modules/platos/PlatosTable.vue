<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

// Vue.component('plato-custom-actions', require('./CustomActions').default)
Vue.component('plato-detail', require('./DetailRow').default)
Vue.component('plato-restore-update', require('./RestoreUpdate').default)

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../global_templates/table.html'),

  components:{
    'filter-bar': FilterBar,
  },

  data () {
    return {
      field_defs: this.localize(FieldDefs),
      apiUri: '/platos/platos',
      detailComponentName: 'plato-detail',
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
