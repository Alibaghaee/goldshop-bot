<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

Vue.component('user-custom-actions', require('./CustomActions'))
Vue.component('user-detail', require('./DetailRow'))

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../global_templates/table.html'),

  components:{
    'filter-bar': FilterBar
  },
  
  data () {
    return {
      field_defs: FieldDefs,
      apiUri: '/users/users',
      detailComponentName: 'user-detail',
      sortOrder: [
        {
          field: 'id',
          sortField: 'id',
          direction: 'desc'
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
