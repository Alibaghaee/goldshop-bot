<template>
    <div class="w-full flex flex-col">
        <div v-for="module in modules" v-if="module.controllers.length">
            <div v-text="module.title" class="flex font-bold bg-blue text-white w-full flex px-4 py-1 mb-1 rounded"></div>
            <div v-for="controller in module.controllers" v-if="controller.actions.length">
                <facilities :controller="controller" :active-actions="activeActions" @select="onSelect"></facilities>
            </div>
        </div>
        <div class="text-left">
            <button type="submit" class="mb-2 rhc-btn" @click="submit">ثبت</button>
        </div>
    </div>
</template>

<script>
    import Facilities from './../../../components/admin/modules/facilities/Facilities.vue';

    export default {
        components: {
            Facilities
        },
        props: ['modules', 'levelId', 'activeActions'],
        
        data() {
            return {
                selected_actions: [],
                flat_selected_actions: this.selected_actions,
            }
        },

        methods:{
            onSelect (module_id, selected_actions) {
                this.selected_actions[module_id] = selected_actions
                this.flat_selected_actions = _.filter(_.flatten(this.selected_actions))
            },
            submit (){
                axios.put('/facilities/facilities/' + this.levelId ,{ selected_actions: this.flat_selected_actions })
                .then((response)=>{
                    window.location = response.data.redirect;
                }).catch((error)=>{
                    console.log(error.response.data)
                })
            }
        }
    }
</script>