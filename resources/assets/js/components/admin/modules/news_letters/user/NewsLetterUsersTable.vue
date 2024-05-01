<script>

import GlobalVueTableMixin from '../../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

Vue.component('news-letter-users-custom-actions', require('./CustomActions'))
Vue.component('news-letter-users-detail', require('./DetailRow'))

export default {
    mixins: [GlobalVueTableMixin],

    template: require('../../../global_templates/table.html'),

    components: {
        'filter-bar': FilterBar,
    },

    data() {
        return {
            field_defs: FieldDefs,
            apiUri: '/news_letters/news_letters/create',
            detailComponentName: 'news-letter-detail',
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
