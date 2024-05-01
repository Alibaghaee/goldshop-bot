<template>
    <div>
    
        <div v-if="isOpen" v-show="action.visible" v-for="action in item.actions" class="bg-grey-lighter">
            <a :href="action.url" class="no-underline text-grey-darker hover:text-blue-dark h-16 flex items-center p-2 pl-6 cursor-pointer has-ripple">
                <div 
                v-text="action.title" 
                :class="[item.visible ? 'mr-8' : 'mr-6', {'text-blue' : ownPath(action.url)}]"
                ></div>
            </a>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['item', 'isOpen'],

        computed: {
            pathname() {
                return window.location.pathname
            }
        },

        methods: {
            ownPath(url){
                return this.pathname == url
            }
        }
    }
</script>
