<template>
    <div class="flex justify-center -mx-1">
        <input

            type="checkbox" name="user_ids[]"
            :checked="list.indexOf(rowData.id) > -1"
            v-on:click="onClick(rowData.id,$event)"
            value="rowData.id">
    </div>
</template>

<script>
import CustomActionsMixin from './../../../mixins/CustomActionsMixin'
import {EventBus} from "../../../../../event-bus";
// import Vue from "vue";
// import VueEvents from "vue-events";

// Vue.use(VueEvents)

export default {
    mixins: [CustomActionsMixin],


    data() {
        return {
            checkedCond: 'unchecked',

            list: [],
        }
    },
    created() {


        // this.$events.$on('refresh', eventData => {
        //
        //     this.onInit();
        // });
        // this.$events.$on('filter-set', eventData => {
        //
        //     this.onInit();
        // });
        // this.$events.$on('filter-reset', eventData => {
        //
        //     this.onInit();
        // });
        // this.$events.$on('item-edit', eventData => {
        //
        //     this.onInit();
        // });
        // this.$events.$on('item-delete', eventData => {
        //
        //     this.onInit();
        // });
        // this.$events.$on('reload', eventData => {
        //
        //     this.onInit();
        // });
        // EventBus.$on('pagination', data => {
        //
        //     if (data === 'ChangePage') {
        //
        //         this.onInit();
        //     }
        // });


        this.onInit();
    },
    methods: {
        onInit() {


            EventBus.$on("usersSelectionCond", (cond) => {


                if (cond === 'selected_all') {

                    EventBus.$emit('setUserId', this.rowData.id);
                    // this.checkedCond = 'checked';
                } else if (cond === 'unselected_all') {

                    EventBus.$emit('unsetUserId', this.rowData.id);
                    // this.checkedCond = 'unchecked';
                }
            });
            EventBus.$on("usersSelectionList", (list) => {

                this.list = list;
            });
        },
        onClick(id, event) {
            if (event.target.checked) {
                /// set id

                EventBus.$emit('setUserId', id);
            } else {

                /// unset id
                EventBus.$emit('unsetUserId', id);
            }
        }
    },


}
</script>
