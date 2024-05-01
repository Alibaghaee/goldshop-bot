<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

// Vue.component('sms-receive-custom-actions', require('./CustomActions'))
// Vue.component('sms-receive-detail', require('./DetailRow'))

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../global_templates/table.html'),

  components:{
    'filter-bar': FilterBar,
  },
  
  data () {
    return {
      field_defs: FieldDefs,
      apiUri: '/sms_receives/sms_receives',
      detailComponentName: '',
      sortOrder: [
        {
          sortField: '_id',
          direction: 'desc'
        }
      ],
    }
  },

  computed: {
      reloadTime(){
        // return window.App.blacklistReloadTime
        return 5000
      }
    },

    methods : {
      runReload(){
        this.intervalId = setInterval(function(){ 
          // console.log((new Date()).getSeconds())
          this.$events.fire('reload')
        }.bind(this), this.reloadTime);
      },

      advanceReload(){
        this.runReload()

        window.addEventListener("click", function(){
          // reset interval
          clearInterval(this.intervalId)
          this.runReload()
        }.bind(this));
      }
    },

    mounted (){
      this.advanceReload()
    }

}

</script>
