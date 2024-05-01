<script>
import GlobalVueTableMixin from "./../../mixins/GlobalVueTableMixin";
import FieldDefs from "./FieldDefs";
import FilterBar from "./FilterBar";

Vue.component("report-file-custom-actions", require("./FileCustomActions"));
Vue.component("report-custom-actions", require("./CustomActions"));
Vue.component("report-detail", require("./DetailRow"));

export default {
    mixins: [GlobalVueTableMixin],

    template: require("./../../global_templates/table.html"),

    components: {
        "filter-bar": FilterBar
    },

    data() {
        return {
            field_defs: FieldDefs,
            apiUri: "/reports/reports",
            detailComponentName: "",
            sortOrder: [
                {
                    sortField: "id",
                    direction: "desc"
                }
            ]
        };
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
};
</script>
