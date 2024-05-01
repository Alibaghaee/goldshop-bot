<template>
  <div class="unselectable">
    <div class="container mt-4" v-if="!services.length">
      <div class="w-full md:w-1/3 bg-white rounded-lg p-4 py-6 md:px-8 my-8 text-center text-xl font-medium">
          {{ $t('No requests at the moment') }}
      </div>
    </div>

    <div class="container" v-else>
        <div class="rounded-lg flex flex-wrap p-4 py-3 md:px-8 my-4 md:my-8 justify-between items-center leading-normal" v-if="show_parent_services && !showOptions()">
            <div class="text-xl md:text-2xl font-medium">{{ $t('What do you need help with?') }}</div>
            <!-- <img src="/image/site/mic.svg" class="hidden md:block w-10 h-10 opacity-50" alt="mic"> -->
        </div>

        <!-- Services List Start -->
        <div class="flex flex-wrap -mx-2 md:-mx-4" v-if="show_parent_services && !showOptions()">
            <div class="w-1/2 md:w-1/4 lg:w-1/5 xl:w-1/6 mb-4 md:mb-8" v-for="service in services">
                <div class="bg-white flex flex-col md:mx-4 md:p-4 md:py-2 rounded-lg shadow text-center text-grey-dark h-full mx-2 p-2 cursor-pointer" @click="selectService(service)" :class="requestableServiceBorder(service)">
                    <img class="h-32 p-2" :src="service.icon" :alt="service.title">
                    <div class="mt-2 md:mt-4 font-medium">{{ service.title }}</div>
                </div>
            </div>
        </div>
        <!-- Services List End -->

        <!-- Service Children Start -->
        <div class="flex flex-wrap items-center justify-between my-4 md:my-8 p-3 py-3 md:px-8 rounded-lg" v-if="selected_service">
            <div class="rahco-center relative">
                <!-- <div class="flex h-16 justify-center mx-auto relative rounded-full text-center w-16">
                    <img :alt="selected_service.icon" class="w-48 md:w-64" :src="selected_service.icon"/>
                </div> -->
                <div class="leading-tight">
                  <div class="text-xl md:text-2xl font-semibold">{{ selected_service.title }}</div>
                  <!-- <div>{{ selected_service.description }}</div> -->
                </div>
            </div>
            <!-- <img src="/image/site/mic.svg" class="hidden md:block w-10 h-10 opacity-50" alt="mic"> -->
        </div>


        <div class="flex flex-wrap -mx-2 md:-mx-4 mb-24 md:mb-0" v-if="selected_service && selected_service.children.length">
            <div class="w-full md:w-1/2 mb-4 md:mb-8" v-for="service in selected_service.children">
                <div class="rounded-lg bg-white mx-2 md:mx-4 flex text-grey-darker cursor-pointer" @click="selectService(service)" :class="requestableServiceBorder(service)">
                    <div class="lg:w-1/4 flex flex-col md:flex-row items-center py-2 px-3 md:py-3 md:px-8">
                        <div class="relative rahco-center">
                            <div class="text-center relative flex justify-center mx-auto rounded-full w-16 h-16">
                                <img :alt="service.title" class="w-48 md:w-64" :src="service.icon"/>
                            </div>
                        </div>
                    </div>
                    <div class="md:border-grey-lighter md:border-l-2 flex items-center md:px-6 md:py-3 lg:w-3/4 px-3 py-2 md:w-2/3 w-full justify-between">
                        <div class="leading-tight">
                            <div class="flex flex-wrap justify-between">
                                <div class="text-xl md:text-2xl font-medium">{{ service.title }}</div>
                            </div>
                        </div>
                        <img src="/image/site/arrow.svg" alt="arrow" v-if="showArrow(service)" class="md:hidden">
                    </div>
                </div>
            </div>
        </div>
        <!-- Service Children End -->

        <!-- options -->
        <div class="flex flex-wrap items-center justify-between my-4 md:my-8 p-3 py-3 md:px-8 rounded-lg" v-if="showOptions()">
            <div class="rahco-center relative">
                <!-- <div class="flex h-16 justify-center mx-auto relative rounded-full text-center w-16">
                    <img :alt="requestable_service.icon" class="w-48 md:w-64" :src="requestable_service.icon"/>
                </div> -->
                <div class="leading-tight">
                  <div class="text-xl md:text-2xl font-medium">{{ requestable_service.title }}</div>
                  <!-- <div class="font-medium">{{ requestable_service.description }}</div> -->
                </div>
            </div>
            <!-- <img src="/image/site/mic.svg" class="hidden md:block w-10 h-10 opacity-50" alt="mic"> -->
        </div>

        <div class="flex flex-wrap -mx-2 md:-mx-4 mb-24 md:mb-0" v-if="showOptions()">
            <div class="w-full md:w-1/2 mb-4 md:mb-8" v-for="option in requestable_service.options">
                <div class="rounded-lg bg-white mx-2 md:mx-4 flex text-grey-darker cursor-pointer border-2 border-white" @click="selectOption(option)">
                    <div class="lg:w-1/4 flex flex-col md:flex-row items-center py-2 px-3 md:py-3 md:px-8">
                        <div class="relative rahco-center">
                            <div class="text-center relative flex justify-center mx-auto rounded-full w-16 h-16 cursor-pointer">
                                <img :alt="option.local_title" class="w-48 md:w-64" :src="option.image"/>
                            </div>
                        </div>
                    </div>
                    <div class="md:border-grey-lighter md:border-l-2 flex items-center md:px-6 md:py-3 lg:w-3/4 px-3 py-2 md:w-2/3 justify-between w-full">
                        <div class="leading-tight">
                            <div class="flex flex-wrap justify-between">
                                <div class="text-xl md:text-2xl cursor-pointer font-medium">{{ option.local_title }}</div>
                            </div>
                        </div>
                        <div>
                            <div class="form-switch -my-2">
                                <input type="checkbox" :name="option.id" :id="option.id" class="form-switch-checkbox" v-model="selected_options[option.id]"> 
                                <!-- <label :for="option.id" class="form-switch-label"></label> -->
                                <label class="form-switch-label"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- options -->

        <div class="flex font-medium bottom-fixed-menu" v-if="requestable_service || selected_service != null">
          <div class="text-sm bg-white block no-underline no-underline p-3 rounded-full text-center text-indigo-dark w-1/2 md:w-48 hover:bg-indigo-dark hover:text-white border-2 border-indigo-dark cursor-pointer" @click="reset()">{{ $t('Back') }}</div>
          <div class="text-sm hover:bg-white block no-underline no-underline p-3 rounded-full text-center hover:text-indigo-dark w-1/2 md:w-48 bg-indigo-dark text-white border-2 border-indigo-dark cursor-pointer ml-4" v-if="requestable_service" @click="confirm()">{{ $t('Confirm') }}</div>
          <div class="text-sm block no-underline no-underline p-3 rounded-full text-center w-1/2 md:w-48 bg-indigo-dark text-white border-2 border-indigo-dark ml-4 opacity-50" v-else>{{ $t('Confirm') }}</div>
        </div>
    </div>
  </div>
</template>

<script>

  export default {
    props : ['services'],

    data (){
      return {
        selected_service : null,
        requestable_service : null,
        selected_option : null,
        selected_options : {},
        show_parent_services : true,
      }
    },

    methods:{
      selectService(service){
        this.selected_option = null 
        this.selected_options = {} 

        if (!this.isRequestable(service)) {
          this.requestable_service = null
          this.selected_service = service
        }else{
          this.requestable_service = service
        }
        if (this.isRequestable(service) && (this.hasOption(service) || service.parent_item_id == null)) {
          this.selected_service = null
        }

        if (!this.isRequestable(service) && service.parent_item_id == null) {
          this.show_parent_services = false
        }
      },

      selectOption(option){
        this.selected_option = option
        this.$set(this.selected_options, option.id, !this.selected_options[option.id])
      },

      requestableServiceBorder(service){
        if (this.isRequestableSelected(service)) {
          return 'border-2 border-indigo-dark'
        }
        return 'border-2 border-white'
      },

      isRequestable(service){
        return !(service && service.children && service.children.length)
      },

      isRequestableSelected(service){
        return this.requestable_service && (this.requestable_service.id == service.id) && this.isRequestable(service)
      },

      hasOption(service){
        return service.options && service.options.length
      },
      showOptions(){
        return this.requestable_service && this.requestable_service.options && this.requestable_service.options.length
      },

      reset(){
        this.selected_service = null
        this.requestable_service = null
        this.selected_option = null
        this.selected_options = {}
        this.show_parent_services = true
      },

      confirm(){
        let endpoint = genrateAddress('user/services')
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

      showArrow(service){
        return (service.children && service.children.length) || (service.options && service.options.length)
      },
      
    }
  }
</script>