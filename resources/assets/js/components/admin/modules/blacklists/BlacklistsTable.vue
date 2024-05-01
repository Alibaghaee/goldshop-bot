<script>

import GlobalVueTableMixin from './../../mixins/GlobalVueTableMixin'
import FieldDefs from './FieldDefs'
import FilterBar from './FilterBar'

Vue.component('blacklist-custom-actions', require('./CustomActions'))
Vue.component('blacklist-detail', require('./DetailRow'))

export default {
  mixins: [GlobalVueTableMixin],

  template: require('./../../global_templates/table.html'),

  components:{
    'filter-bar': FilterBar,
  },
  
  data () {
    return {
      field_defs: FieldDefs,
      apiUri: '/blacklists/blacklists',
      detailComponentName: 'blacklist-detail',
      sortOrder: [
        // {
        //   sortField: 'id',
        //   direction: 'desc'
        // }
      ],
      intervalId: 0,
    }
  },

  computed: {
    reloadTime(){
      return window.App.blacklistReloadTime
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
