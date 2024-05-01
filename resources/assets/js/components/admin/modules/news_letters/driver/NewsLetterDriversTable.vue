<script>

import GlobalVueTableMixin from '../../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

Vue.component('news-letter-drivers-custom-actions', require('./CustomActions'))
Vue.component('news-letter-drivers-detail', require('./DetailRow'))

export default {
    mixins: [GlobalVueTableMixin],

    template: require('../../../global_templates/table.html'),

    components: {
        'filter-bar': FilterBar,
    },

    data() {
        return {
            field_defs: FieldDefs,
            apiUri: '/news_letters/news_letters/driversCreate',
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
