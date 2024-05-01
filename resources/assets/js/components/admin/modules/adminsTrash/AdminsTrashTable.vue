<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

Vue.component('admin-trash-custom-actions', require('./CustomActions').default)

Vue.component('admin-trash-detail', require('./DetailRow'))

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../global_templates/table.html'),

  components:{
    'filter-bar': FilterBar
  },
  
  data () {
    return {
      field_defs: this.localize(FieldDefs),
      apiUri: '/admins/admins/trash',
      detailComponentName: 'admin-trash-detail',
      sortOrder: [
        {
          field: 'email',
          sortField: 'email',
          direction: 'asc'
        }
      ],
    }
  },

  methods: {
    genderLabel (value) {
      return value === 'M'
        ? '<span class="ui teal label"><i class="large man icon"></i>Male</span>'
        : '<span class="ui pink label"><i class="large woman icon"></i>Female</span>'
    }
  }
}

</script>
