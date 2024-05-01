<script>

import GlobalVueTableMixin from '../../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

Vue.component('single-sms-send-contact-numbers-custom-actions', require('./CustomActions'))
Vue.component('single-sms-send-contact-numbers-detail', require('./DetailRow'))

export default {
    mixins: [GlobalVueTableMixin],

    template: require('../../../global_templates/table.html'),

    components: {
        'filter-bar': FilterBar,
    },

    data() {
        return {
            field_defs: FieldDefs,
            apiUri: '/single_sms_senders/single_sms_senders/create',
            detailComponentName: 'single-sms-send-contact-numbers-detail',
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
