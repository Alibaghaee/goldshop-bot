<template>

    <div>
        <div class="text-3xl mb-4 font-medium">{{ $t('FAQ') }}</div>

        <div class="-mb-6">
            <div class="mb-6" v-for="item in items">
                <div class="w-full border-b py-2 flex justify-between items-center cursor-pointer" @click="toggle(item)">
                    <div class="font-medium">{{ item.title }}</div>
                    <img class="accordion-icon" src="/image/site/minus.svg" alt="minus" v-if="open_item == item.id">
                    <img class="accordion-icon" src="/image/site/plus.svg" alt="plus" v-else>
                </div>
                <transition v-on:enter="enter" v-on:leave="leave" name="component-fade" mode="out-in">
                    <div class="py-4 text-sm opacity-75" v-if="open_item == item.id">{{ item.description }}</div>
                </transition>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['data'],
        data () {
            return {
                open_item: null,
                items: this.data
            }
        },
        methods: {
          
          enter: function(el, done){   
            Velocity(el, 'slideDown', {
                    duration: 170,  
                    easing: "easeInBack"
                },
                {
                    complete: done
                }
            )},
          
          leave: function(el, done){
              Velocity(el, 'slideUp', {
                      duration: 170,  
                      easing: "easeInBack"
                  },
                  {
                      complete: done
                  }
              )},

            toggle(item){
                if (this.open_item == item.id) {
                    this.open_item = null
                }else{
                    this.open_item = item.id
                }
            }
        }, 
    }
</script>