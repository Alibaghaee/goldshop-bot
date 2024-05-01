<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

// Vue.component('tabiat-product-custom-actions', require('./CustomActions'))
// Vue.component('tabiat-product-detail', require('./DetailRow'))

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../global_templates/table.html'),

  components:{
    'filter-bar': FilterBar,
  },
  
  data () {
    return {
      field_defs: FieldDefs,
      apiUri: '/tabiat_products/tabiat_products',
      detailComponentName: '',
      sortOrder: [
        {
          sortField: '_id',
          direction: 'desc'
        }
      ],
    }
  },

}

</script>
