<template>
    <div>

        <div @click="toggle" class="h-16 bg-white flex justify-between items-center cursor-pointer hover:text-blue-dark" :class="{'text-blue' : isOpen}">
            <div class="p-2 pr-4 flex">
                <svg class="fill-current w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 416 416"><path d="M208 0C93.1 0 0 93.1 0 208s93.1 208 208 208 208-93.1 208-208S322.9 0 208 0zm-32.1 281.7c-2.4 2.4-5.8 4.4-8.8 4.4s-6.4-2.1-8.9-4.5l-56-56 17.8-17.8 47.2 47.2L292 129.3l17.5 18.1-133.6 134.3z"/></svg>
                <div v-text="item.title"></div>
            </div>
            <div class="flex justify-center mx-4">
                <svg v-if="isOpen" class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 192"><path d="M300.6 0L320 20.7 160 192 0 20.7 19.3 0 160 150.5z"/></svg>
                <svg v-else class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 320"><path d="M192 19.4L171.3 0 0 160l171.3 160 20.7-19.3L41.5 160z"/></svg>
            </div>
        </div>

        <side-nav-first-level 
        v-if="isOpen"
        v-for="(item, index) in item.controllers" 
        :item="item" 
        :key="index" 
        :isOpen="checkIsOpen(index, item)"
        @toggled="onToggle"
        ></side-nav-first-level>

        
    </div>
</template>

<script>
    import SideNavFirstLevel from './SideNavFirstLevel';

    export default {

        props: ['item', 'isOpen', 'activeController', 'search'],

        components: {
            SideNavFirstLevel
        },

        data(){
            return {
                activeItemIndex: false
            }
        },

        methods: {
            toggle (){
                this.$emit('toggled', this.$vnode.key)
                this.activeItemIndex = null
            },

            onToggle (index){
                if (this.activeItemIndex == index) {
                    this.activeItemIndex = null
                    return ;
                }
                this.activeItemIndex = index
            },
            checkIsOpen(index, item){
                if (this.search.length != 0) {
                    return true
                }else if (this.activeItemIndex === false && this.activeController) {
                    return this.activeItemIndex === index || item.visible == false || item.id == this.activeController.id
                }else{
                    return this.activeItemIndex === index || item.visible == false
                }
            }
        }

    }
</script>
