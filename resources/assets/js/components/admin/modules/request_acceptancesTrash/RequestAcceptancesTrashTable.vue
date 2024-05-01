<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

Vue.component('request-acceptance-trash-custom-actions', require('./CustomActions').default)
// Vue.component('request-acceptance-detail', require('./DetailRow').default)

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../global_templates/table.html'),

  components: {
    'filter-bar': FilterBar,
  },

  data() {
    return {
      field_defs: this.localize(FieldDefs),
      apiUri: '/request_acceptances/request_acceptances/trash',
      detailComponentName: '',
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
