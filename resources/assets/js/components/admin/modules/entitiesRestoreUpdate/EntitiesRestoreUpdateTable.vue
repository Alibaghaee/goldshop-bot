<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

// Vue.component('entity-custom-actions', require('./CustomActions').default)
Vue.component('entity-restore-update-detail', require('./DetailRow').default)
Vue.component('entity-restore-update-action', require('./RestoreUpdate').default)

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../global_templates/table.html'),

  components: {
    'filter-bar': FilterBar,
  },

  data() {

    return {
      field_defs: this.localize(FieldDefs),
      apiUri: '/entities/entities/restoreUpdateIndex/' + this.model.id,
      detailComponentName: 'entity-restore-update-detail',
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
