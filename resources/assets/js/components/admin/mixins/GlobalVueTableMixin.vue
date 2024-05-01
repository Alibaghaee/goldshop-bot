<script>
import accounting from 'accounting'
import moment from 'moment'
import Vuetable from 'vuetable-2/src/components/Vuetable'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
import VuetablePaginationDropdown from 'vuetable-2/src/components/VuetablePaginationDropdown.vue'
import Vue from 'vue'
import VueEvents from 'vue-events'
import FieldDefsCallbacks from './FieldDefsCallbacks'
import {EventBus} from "../../../event-bus";

Vue.use(VueEvents)
Vue.component('vuetable-pagination-dropdown', VuetablePaginationDropdown)


export default {
    mixins: [FieldDefsCallbacks],
    components: {
        Vuetable,
        VuetablePagination,
        VuetablePaginationInfo,
    },
    props: ['data', 'page_title', 'model'],
    data() {
        return {
            perpage: 20,
            moreParams: {},
            filterBarErrors: {},
            isFilterOpen: false,
        }
    },
    created() {
        this.setUrlSearchParams();
    },
    mounted() {
        this.$events.$on('filter-set', eventData => this.onFilterSet(eventData))
        this.$events.$on('filter-reset', e => this.onFilterReset())
        this.$events.$on('item-edit', eventData => this.onItemEdit(eventData))
        this.$events.$on('item-delete', eventData => this.onItemDelete(eventData))
        this.$events.$on('refresh', eventData => this.onRefreshRequest())
        this.$events.$on('reload', eventData => this.onReload(eventData))
    },
    computed: {
        showTopPagination() {
            return this.perpage >= 15
        }
    },

    methods: {
        formatNumber(value) {
            return accounting.formatNumber(value, 0)
        },
        formatDate(value, fmt = 'D MMM YYYY') {
            return (value == null)
                ? ''
                : moment(value, 'YYYY-MM-DD').format(fmt)
        },
        onPaginationData(paginationData) {
            this.$refs.pagination.setPaginationData(paginationData)
            this.$refs.paginationInfo.setPaginationData(paginationData)
            this.$refs.paginationdropdown.setPaginationData(paginationData)
            this.$refs.paginationTop.setPaginationData(paginationData)
            this.$refs.paginationInfoTop.setPaginationData(paginationData)
        },
        onChangePage(page) {

            EventBus.$emit('pagination', 'ChangePage');
            this.$refs.vuetable.changePage(page)
        },
        onAction(action, data, index) {
            console.log('slot action: ' + action, data.name, index)
        },
        onCellClicked(data, field, event) {
            console.log('cellClicked: ', field.name)
            this.$refs.vuetable.toggleDetailRow(data.id)
        },
        onFilterSet(formData) {
            // this.moreParams.filter = formData.filterText
            // this.moreParams.name = formData.name
            // this.moreParams.date = formData.date
            this.moreParams = formData
            Vue.nextTick(() => this.$refs.vuetable.refresh())
        },
        onFilterReset() {
            // delete this.moreParams.filter
            Vue.nextTick(() => this.$refs.vuetable.refresh())
        },
        onRefreshRequest() {
            Vue.nextTick(() => this.$refs.vuetable.refresh())
        },
        onItemEdit(data) {
            console.log(data)
            flash('edit')
        },
        onItemDelete(data) {
            Vue.nextTick(() => this.$refs.vuetable.reload())
            // console.log(data)
            // flash('delete', 'error')
        },
        onReload(data) {
            Vue.nextTick(() => this.$refs.vuetable.reload())
        },
        onChangePerPage() {
            this.$refs.vuetable.refresh()
        },
        setErrors(data) {
            this.filterBarErrors = data.response.data.errors
        },
        setUrlSearchParams() {


            var searchParams = new URLSearchParams(window.location.search);
            searchParams.forEach(function (value, key) {
                this.moreParams[key] = value;
            }.bind(this));
        },
    }
}
</script>
