<template>
  <div class="container my-4 md:my-8 unselectable">
      <transition-group name="list-complete" class="flex flex-wrap -mx-4" tag="div">
        <div class="w-full lg:w-1/2 mb-4 md:mb-8 list-complete-item" v-bind:key="item.id" v-for="item in items">
            <div class="rounded-lg mx-4 flex text-grey-darker cursor-pointer" :class="[isDone(item) ? 'bg-grey-light' : 'bg-white']" >
                <div class="md:w-1/4 flex flex-col md:flex-row items-center py-2 px-3 md:py-3 md:px-8 border-r-2 border-grey-lighter">
                    <div class="relative rahco-center">
                        <div class="absolute z-10 rahco-center w-20 h-20" v-if="isDone(item)">
                          <img src="/image/site/simple-check-indigo.svg" class="w-16">
                        </div>
                        <div class="text-center relative flex justify-center mx-auto rounded-full w-16 cursor-pointer flex flex-wrap" :class="[isDone(item) ? 'opacity-50' : '']">
                            <img alt="" class="w-48 h-16 md:w-64" :src="item.icon"/>
                            <div :class="{ 'invisible' : isDone(item)}" class="text-xs text-indigo-dark mt-3 font-semibold">{{ created_at_human_string(item.created_at_human) }} {{ $t('Min') }}</div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center md:px-6 md:w-3/4 px-3 py-2 justify-between w-full relative flex flex-wrap" :class="{'opacity-50' : isDone(item)}">
                    <div class="flex flex-1 flex-col justify-between">
                        <div class="flex flex-wrap justify-between">
                            <div class="text-xl md:text-2xl cursor-pointer font-semibold">{{ item.item_title }}</div>
                        </div>
                        <div class="font-medium">{{ item.options_string }}</div>
                    </div>
                    <div class="absolute pin-r pin-t" @click="Delete(item)">
                      <div>
                          <img src="/image/site/letter-x.svg" class="h-4 w-4 m-4 mx-6" alt="cross">
                      </div>
                    </div>
                    <div class="w-full">
                      <div class="w-full flex justify-between items-center md:pr-16 z-10">
                        <img v-if="!isDone(item)" class="w-6 h-6" src="/image/site/check-indigo.svg" alt="">
                        <img v-if="isDone(item)" class="w-6 h-6" src="/image/site/check-grey.svg" alt="">
                        <div class="h-1 rounded bg-grey-light w-full">
                          <div class="h-1 rounded" :class="firstProgressLineClass(item)"></div>
                        </div>
                        <img v-if="isPending(item) || isShared(item)" class="w-6 h-6" src="/image/site/two-circle.svg" alt="">
                        <img v-if="isAccepted(item)" class="w-6 h-6" src="/image/site/check-indigo.svg" alt="">
                        <img v-if="isDone(item)" class="w-6 h-6" src="/image/site/check-grey.svg" alt="">
                        <div class="h-1 rounded bg-grey-light w-full">
                          <div class="h-1 rounded" :class="secondProgressLineClass(item)"></div>
                        </div>
                        <img v-if="!isDone(item)" class="w-6 h-6" src="/image/site/three-circle.svg" alt="">
                        <img v-if="isDone(item)" class="w-6 h-6" src="/image/site/double-check-gray.svg" alt="">
                      </div>
                      <div class="w-full flex justify-between items-center md:pr-10 md:-mx-3 mt-1" style="font-size: 10px;">
                        <div>{{ $t('Sent') }}</div>
                        <div>{{ $t('In Progress') }}</div>
                        <div>{{ $t('Done') }}</div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
      </transition-group>

      <div class="w-full mb-4 md:mb-6 p-6 text-center text-xl">
          <a :href="getAddress('user/services')" class="text-sm bg-white block no-underline no-underline p-3 rounded-full text-center hover:text-indigo-dark hover:bg-white w-48 bg-indigo-dark text-white border-2 border-indigo-dark mx-auto cursor-pointer font-medium">{{ $t('Make a request') }}</a>
      </div>
  </div>
</template>

<script>

  export default {
    props : ['request_items'],

    data (){
      return {
        items: this.request_items
      }
    },

    methods:{
      confirm(){
        let endpoint = genrateAddress('user/your_requests/')
        let data = {
          'service_id' : this.requestable_service.id,
          'options' : this.selected_options,
        }

        axios.post(endpoint, data)
        .then(function (response){
          this.reset()
          flash('Your request was successfully submitted.')
        }.bind(this))
        .catch(function(error){
          flash('Error', 'error')
        });
      },

      isPending(item){
        return item.status_id == 0;
      },

      isAccepted(item){
        return item.status_id == 1;
      },

      isDone(item){
        return item.status_id == 2;
      },

      isShared(item){
        return item.status_id == 4;
      },

      firstProgressLineClass(item){
        if (this.isPending(item) || this.isShared(item)) {
          return 'bg-indigo-dark w-2/5'
        }
        if (this.isAccepted(item)) {
          return 'bg-indigo-dark w-full'
        }
        if (this.isDone(item)) {
          return 'bg-grey-1 w-full'
        }
      },

      secondProgressLineClass(item){
        if (this.isPending(item)) {
          return 'hidden'
        }
        if (this.isAccepted(item)) {
          return 'bg-indigo-dark w-2/5'
        }
        if (this.isDone(item)) {
          return 'bg-grey-1 w-full'
        }
      },

      reload(){
        let endpoint = 'user/your_requests'

        axios.get(genrateAddress(endpoint))
        .then(function (response){
          this.items = response.data.data
        }.bind(this))
        .catch(function(error){
          flash('Error', 'error')
        });
      },

      Delete(item){
        // if (this.isDone(item)) {
        //   return ;
        // }
        let endpoint = genrateAddress('user/your_requests/' + item.id)

        axios.delete(endpoint)
        .then(function (response){
          this.reload()
          // flash('Your request was successfully deleted.')
        }.bind(this))
        .catch(function(error){
          // flash('Error', 'error')
        });
      },

      created_at_human_string(minutes){
        return minutes + ' '
      },

      patientRequestAcceptEvent(){
        var patient_channel_one = Echo.private(`request-accept.${window.App.user_id}`)
        patient_channel_one.listen('.patient-request-accept-event', (e) => {
          this.reload()
        });
      },

      getAddress(address){
        return genrateAddress(address)
      }

    },

    mounted(){
      setInterval(function() {
        this.items.forEach(function(item){
          item.created_at_human++
        });
      }.bind(this), 1000 * 60);
    },

    created(){
      this.patientRequestAcceptEvent()
    }
    
  }
</script>