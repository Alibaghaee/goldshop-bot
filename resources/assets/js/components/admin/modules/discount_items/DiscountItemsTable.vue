<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

// Vue.component('discount-item-custom-actions', require('./CustomActions'))
Vue.component('discount-item-detail', require('./DetailRow'))

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../global_templates/table-items.html'),

  components:{
    'filter-bar': FilterBar,
  },
  
  data () {
    return {
      field_defs: FieldDefs,
      apiUri: '/discounts/' + this.model.id + '/discount_items',
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
