<template>
    <div class="text-grey-darkest border-l border-grey-lighter">
        <div class="p-2">
            <input type="text" class="rhc-form-control text-black border-0 h-12 outline-none shadow-inner" placeholder="جستجو" v-model="search">
        </div>

        <side-nav-top-level 
        v-for="(item, index) in allItems" 
        :item="item" 
        :key="index" 
        :isOpen="checkIsOpen(index, item)"
        :active-controller="activeController"
        :search="search"
        @toggled="onToggle"
        >
        </side-nav-top-level>
        
    </div>
</template>

<script>
    import SideNavTopLevel from './SideNavTopLevel';

    export default {

        props: ['items', 'active-controller'],

        components: {
            SideNavTopLevel
        },

        data() {
            return {
                allItems: this.items,
                activeItemIndex: false,
                search: ''
            }
        },

        watch : {
            search (val){
                if (val.length != 0) {
                    this.allItems = _.filter(this.items, function(module) {
                        let controllers = _.filter(module.controllers, function(controller) {

                            let actions = _.filter(controller.actions, function(action) {
                                return _.includes(action.title, this.search) && action.visible
                            }.bind(this));
                            // check for controller includes
                            let controllerInclude = _.includes(controller.title, this.search)
                            // check for action includes
                            let actionInclude = actions.length
                            return (controllerInclude && controller.visible) || actionInclude

                        }.bind(this));

                        // check for module includes
                        let moduleInclude = _.includes(module.title, this.search)
                        // check for controller includes
                        let controllersInclude = controllers.length
                        return moduleInclude || controllersInclude

                     }.bind(this));
                    return;
                }
                this.allItems = this.items
            }
        },

        methods:{
            onToggle (index){
                if(this.activeItemIndex === index){
                    this.activeItemIndex = null
                    return ;
                }
                this.activeItemIndex = index
            },
            checkIsOpen(index, item){
                if (this.search.length != 0) {
                    return true
                }else if (this.activeItemIndex === false && this.activeController) {
                    return this.activeItemIndex === index || item.id == this.activeController.module_id
                }else{
                    return this.activeItemIndex === index
                }
            }
        }
    }
</script>
