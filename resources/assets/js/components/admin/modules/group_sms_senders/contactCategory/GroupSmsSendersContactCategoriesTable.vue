<script>

import GlobalVueTableMixin from '../../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

Vue.component('group-sms-send-contact-categories-custom-actions', require('./CustomActions'))
Vue.component('group-sms-send-contact-categories-detail', require('./DetailRow'))

export default {
    mixins: [GlobalVueTableMixin],

    template: require('../../../global_templates/table.html'),

    components: {
        'filter-bar': FilterBar,
    },

    data() {
        return {
            field_defs: FieldDefs,
            apiUri: '/group_sms_senders/group_sms_senders/create',
            detailComponentName: 'group-sms-send-contact-categories-detail',
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
