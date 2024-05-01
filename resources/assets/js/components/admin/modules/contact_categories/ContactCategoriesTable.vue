<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

Vue.component('contact-category-custom-actions', require('./CustomActions'))
Vue.component('contact-category-detail', require('./DetailRow'))

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../global_templates/table.html'),

  components:{
    'filter-bar': FilterBar,
  },

  data () {
    return {
      field_defs: FieldDefs,
      apiUri: '/contact_categories/contact_categories',
      detailComponentName: 'contact-category-detail',
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
