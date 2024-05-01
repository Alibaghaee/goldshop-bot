<template>
    <transition name=fade>
        <div class="rhc-flash-alert"
             :class="'rhc-alert-'+level"
             role="alert"
             v-show="show"
             v-text="body">
        </div>
    </transition>
</template>

<script>
    export default {
        props: ['message', 'level_name'],

        data (){
            return {
                body: this.message,
                level: this.level_name,
                show: false
            }
        },

        created (){
            if (this.message) {
                this.flash();
            }

            window.events.$on('flash', data => this.flash(data));
        },

        methods: {
            flash(data){
                if (data) {
                    this.body = data.message;
                    this.level = data.level;
                }
                setTimeout(() => {
                    this.show = true;
                }, 1);

                this.hide();
            },

            hide (){
                setTimeout(() => {
                    this.show = false;
                }, 4000);
            }
        }
    }
</script>