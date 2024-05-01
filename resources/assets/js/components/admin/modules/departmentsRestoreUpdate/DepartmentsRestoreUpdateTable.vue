<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

// Vue.component('department-custom-actions', require('./CustomActions').default)
Vue.component('department-restore-update-detail', require('./DetailRow').default)
Vue.component('department-restore-update', require('./RestoreUpdate').default)

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../global_templates/table.html'),

  components: {
    'filter-bar': FilterBar,
  },

  data() {

    return {
      field_defs: this.localize(FieldDefs),
      apiUri: '/departments/departments/restoreUpdateIndex/' + this.model.id,
      detailComponentName: 'department-restore-update-detail',
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
