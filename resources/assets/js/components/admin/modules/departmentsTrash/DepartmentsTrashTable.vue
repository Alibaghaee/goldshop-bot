<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

 Vue.component('department-trash-detail', require('./DetailRow').default)
Vue.component('department-trash-custom-actions', require('./CustomActions').default)

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../global_templates/table.html'),

  components:{
    'filter-bar': FilterBar,
  },
  
  data () {
    return {
      field_defs: this.localize(FieldDefs),
      apiUri: '/departments/departments/trash',
      detailComponentName: 'department-trash-detail',
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
