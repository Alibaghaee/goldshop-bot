<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

// Vue.component('request-custom-actions', require('./CustomActions').default)
Vue.component('request-restore-update-detail', require('./DetailRow').default)
Vue.component('request-restore-update-action', require('./RestoreUpdate').default)

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../global_templates/table.html'),

  components: {
    'filter-bar': FilterBar,
  },

  data() {

    return {
      field_defs: this.localize(FieldDefs),
      apiUri: '/requests/requests/restoreUpdateIndex/' + this.model.id,
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
