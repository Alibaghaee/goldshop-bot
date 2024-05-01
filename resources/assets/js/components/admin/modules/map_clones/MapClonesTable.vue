<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

Vue.component('map-clone-custom-actions', require('./CustomActions'))
Vue.component('map-clone-detail', require('./DetailRow'))

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../global_templates/table.html'),

  components:{
    'filter-bar': FilterBar,
  },

  data () {
    return {
      field_defs: FieldDefs,
      apiUri: '/maps/maps/index_clone/' + this.model.id+'/',
      detailComponentName: 'map-clone-detail',
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
