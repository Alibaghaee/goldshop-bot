<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

Vue.component('plato-trash-custom-actions', require('./CustomActions').default)
Vue.component('plato-trash-detail', require('./DetailRow').default)

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../global_templates/table.html'),

  components: {
    'filter-bar': FilterBar,
  },

  data() {
    return {
      field_defs: this.localize(FieldDefs),
      apiUri: '/platos/platos/trash',
      detailComponentName: 'plato-trash-detail',
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
