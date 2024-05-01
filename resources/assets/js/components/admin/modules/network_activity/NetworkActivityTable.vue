



<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

Vue.component('network-activity-custom-actions', require('./CustomActions'))
Vue.component('network-activity-detail', require('./DetailRow'))

export default {
    mixins: [GlobalVueTableMixin],

    template: require('./../../global_templates/table.html'),

    components: {
        'filter-bar': FilterBar,
    },

    data() {
        return {
            field_defs: FieldDefs,
            apiUri: '/admin_profiles/admin_profiles/' + this.model.id+'/',
            detailComponentName: 'network-activity-detail',
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
