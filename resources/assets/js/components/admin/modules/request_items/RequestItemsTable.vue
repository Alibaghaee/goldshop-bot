<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

Vue.component('request-item-custom-actions', require('./CustomActions').default)
Vue.component('request-item-detail', require('./DetailRow').default)

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../custom_templates/request-items.html'),

  components: {
    'filter-bar': FilterBar,
  },

  data() {
    return {
      field_defs: this.localize(FieldDefs),
      apiUri: '/requests/' + this.model.id + '/request_items',
      detailComponentName: 'request-item-detail',
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
