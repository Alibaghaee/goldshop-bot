<template>
    <div class="w-full flex flex-col">
        <services :service="services" :active-items="activeItems" @select="onSelect"></services>
        
        <div class="text-left">
            <button type="submit" class="mb-2 rhc-btn" @click="submit">{{ $t('Submit') }}</button>
        </div>
    </div>
</template>

<script>
    import Services from './../../../components/admin/modules/service_categories/Services.vue';

    export default {
        components: {
            Services
        },
        props: ['services', 'endpoint', 'activeItems'],
        
        data() {
            return {
                selected_items: [],
                flat_selected_items: this.selected_items,
            }
        },

        methods:{
            onSelect (parent_item_id, selected_items) {
                this.selected_items = selected_items
                // this.flat_selected_items = _.filter(_.flatten(this.selected_items))
            },
            submit (){
                axios.put(this.endpoint ,{ selected_items: this.selected_items })
                .then((response)=>{
                    window.location = response.data.redirect;
                }).catch((error)=>{
                    console.log(error.response.data)
                })
            }
        }
    }
</script>