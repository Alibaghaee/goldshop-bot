<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

Vue.component('travel-custom-actions', require('./CustomActions'))
Vue.component('travel-detail', require('./DetailRow'))

export default {

    mixins: [GlobalVueTableMixin],

    template: require('./../../global_templates/table.html'),

    components: {
        'filter-bar': FilterBar,
    },

    data() {
        return {
            field_defs: FieldDefs,
            apiUri: '/drivers/drivers/show_travels/' + this.model.id+'/',
            detailComponentName: 'travel-detail',
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
