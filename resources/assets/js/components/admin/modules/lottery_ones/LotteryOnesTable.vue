<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

Vue.component('lottery-one-custom-actions', require('./CustomActions'))
Vue.component('lottery-one-file-custom-actions', require('./FileCustomActions'))
Vue.component('lottery-one-detail', require('./DetailRow'))

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../global_templates/table.html'),

  components: {
    'filter-bar': FilterBar,
  },

  data() {
    return {
      field_defs: FieldDefs,
      apiUri: '/lottery_ones/lottery_ones',
      detailComponentName: 'lottery-one-detail',
      sortOrder: [
        {
          sortField: 'id',
          direction: 'desc'
        }
      ],
    }
  },

  computed: {
        reloadTime() {
            // return window.App.blacklistReloadTime
            return 5000;
        }
    },

    methods: {
        runReload() {
            this.intervalId = setInterval(
                function() {
                    // console.log((new Date()).getSeconds())
                    this.$events.fire("reload");
                }.bind(this),
                this.reloadTime
            );
        },

        advanceReload() {
            this.runReload();

            window.addEventListener(
                "click",
                function() {
                    // reset interval
                    clearInterval(this.intervalId);
                    this.runReload();
                }.bind(this)
            );
        }
    },

    mounted() {
        this.advanceReload();
    }

}

</script>
