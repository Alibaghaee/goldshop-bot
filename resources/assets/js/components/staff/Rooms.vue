<template>
  <div class="unselectable">
    <!-- select rooms start -->
    <div class="container">
        <div class="md:rounded-lg flex flex-wrap px-3 md:py-3 md:px-8 mt-4 md:mt-8 justify-between">
            <div class="flex flex-wrap items-center font-semibold">
                <div>
                    <img src="/image/site/users.svg" class="h-10 w-10 md:h-16 md:w-16 mr-3 md:mr-6" alt="users">
                </div>
                <div class="leading-tight">
                    <div class="text-xl md:text-4xl text-black">{{ $t('Choose your patients') }}</div>
                    <div class="text-purple md:text-2xl">{{ $t('message.available_rooms', [all_rooms.length]) }}</div>
                </div>
            </div>
            <div class="hidden md:flex items-center justify-end w-full md:w-auto text-sm md:text-base font-medium">
                <div class="mr-10 text-center cursor-pointer" @click="selectAll()" v-if="is_all_selected == false">
                    <img src="/image/site/radio.svg" class="w-4 h-4 md:h-8 md:w-8" alt="radio">
                    <div class="mt-1">{{ $t('Select All') }}</div>
                </div>
                <div class="mr-10 text-center cursor-pointer" @click="unselectAll()" v-if="is_all_selected == true">
                    <img src="/image/site/radio-green.svg" class="w-4 h-4 md:h-8 md:w-8" alt="radio">
                    <div class="mt-1">{{ $t('Select All') }}</div>
                </div>
                <div class="text-center cursor-pointer" @click="showDialog()">
                    <img src="/image/site/save-green.svg" class="w-4 h-4 md:h-8 md:w-8" alt="save" v-if="is_saved">
                    <img src="/image/site/save.svg" class="w-4 h-4 md:h-8 md:w-8" alt="save" v-else>
                    <div class="mt-1">{{ $t('Save') }}</div>
                </div>
            </div>
        </div>

        <div class="flex md:hidden rounded-lg bg-white flex-wrap p-4 md:px-8 mt-4 justify-between font-medium shadow md:shadow-none">
            <div class="flex items-center justify-around w-full md:w-auto text-sm md:text-base">
                <div class="text-center" @click="selectAll()" v-if="is_all_selected == false">
                    <img src="/image/site/radio.svg" class="h-6 w-6" alt="radio">
                    <div class="mt-1">{{ $t('Select All') }}</div>
                </div>
                <div class="text-center" @click="unselectAll()" v-if="is_all_selected == true">
                    <img src="/image/site/radio-green.svg" class="h-6 w-6" alt="radio">
                    <div class="mt-1">{{ $t('Select All') }}</div>
                </div>

                <div class="text-center" @click="showDialog()">
                    <img src="/image/site/save-green.svg" class="h-6 w-6" alt="save" v-if="is_saved">
                    <img src="/image/site/save.svg" class="h-6 w-6" alt="save" v-else>
                    <div class="mt-1">{{ $t('Save') }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="flex flex-wrap -mx-1 md:-mx-2 -mb-2">
            <template v-for="room in all_rooms">
            <div class="w-1/2 md:w-1/4 px-1 md:px-2 mb-2 md:mb-4" @click="toggleRoomSelect(room)">
                <div class="flex justify-between items-center rounded-lg p-2 py-4 md:py-4 md:px-6 border-2 border-indigo-lightest cursor-pointer font-medium" :class="[isRoomSelected(room) ? 'bg-indigo-lightest' : 'bg-white']">
                    <div>
                      <div>{{ room.title }}</div>
                      <div class="">{{ room.entities_count }} {{ $t('Bed') }}</div>
                    </div>
                    <img src="/image/site/bed-circle.svg" class="w-6 h-6 md:h-16 md:w-16" alt="bed-circle">
                </div>
            </div>
            </template>
        </div>
    </div>
    <!-- select rooms end -->

    <modal name="confirm" :width="400" :height="230" :adaptive="true" classes="p-4 py-6 text-white">
        <div class="flex flex-col justify-between p-8 h-full bg-indigo-dark text-white rounded-lg">
          <div class="text-center leading-normal">{{ $t('message.selected_room_confirm', [selected_rooms.length]) }}
          <span v-text="" v-if="" class="text-red font-bold"></span>
          </div>
          <div class="flex justify-between items-end h-full">
              <button type="button" class="dialog-btn-type-one" @click="$modal.hide('confirm')">{{ $t('Cancel') }}</button>
              <button type="button" class="dialog-btn-type-one active" @click="updateUserRooms()">{{ $t('Confirm') }}</button>
          </div>
        </div>
    </modal>
  </div>
</template>

<script>
import ClickOutside from 'vue-click-outside'

export default {
  props: ['rooms', 'active_rooms'],

  data () {
    return {
      all_rooms: this.rooms,
      selected_rooms: this.active_rooms,
      is_all_selected: false,
      is_saved: false,
    }
  },

  watch: {
    selected_rooms (){
      this.is_saved = false
      
      if (this.selected_rooms.length != this.all_rooms.length) {
        this.is_all_selected = false
      }else{
        this.is_all_selected = true
      }
    }
  },

  methods: {
    toggleRoomSelect(room){
      if (this.isRoomSelected(room)) {
        this.selected_rooms = _.remove(this.selected_rooms, function(n) { 
          return n != room.id
        }.bind(this))
      }else{
        this.selected_rooms.push(room.id)
      }
    },

    isRoomSelected(room){
      return this.selected_rooms.includes(room.id)
    },

    selectAll(){
      this.selected_rooms = _.map(this.all_rooms, 'id')
      this.is_all_selected = true
    },

    unselectAll(){
      this.selected_rooms = []
      this.is_all_selected = false
    },

    showDialog (data){
      this.$modal.show('confirm')
    },

    updateUserRooms(){
      this.$modal.hide('confirm')
      let endpoint = genrateAddress('rooms')
      let data = {'rooms' : this.selected_rooms}

      axios.put(endpoint, data)
      .then(function (response){
        this.is_saved = true
        // flash('Updated Successfully')
      }.bind(this))
      .catch(function(error){
        // flash('Error', 'error')
      });
    },
  },
}
</script>