<template>
  <div class="unselectable" :key="component_key">
    <!-- <div class="container">
        <div class="md:rounded-lg flex flex-wrap px-3 md:py-3 md:px-8 mt-4 md:mt-8 justify-between">
            <div class="flex flex-wrap items-center">
                <img src="/image/site/users.svg" class="h-10 w-10 md:h-16 md:w-16 mr-3 md:mr-6" alt="users">
                <div class="leading-tight font-semibold">
                    <div class="text-xl md:text-4xl text-black" v-if="all_requests.length">
                      <div v-if="is_all">{{ undone_request.length }} {{ $t('current requests') }}</div>
                      <div v-else>{{ $t('Your requests') }}</div>
                    </div>
                    <div class="text-xl md:text-4xl text-black" v-if="!all_requests.length">{{ $t('No requests at the moment') }}</div>
                    <div class="text-indigo-dark md:text-2xl" v-if="is_all">{{ beds_count }} {{ $t('patients are in Helpchat') }}</div>
                    <div class="text-indigo-dark md:text-2xl" v-else>{{ $t('message.taking_care', [beds_count]) }}</div>
                </div>
            </div>
            <div class="hidden md:flex items-center">
                <div class="mr-10">
                    <img @click="changeView('line')" class="cursor-pointer w-10" :class="{ 'opacity-50 filter-grayscale' : view_type != 'line' }" src="/image/site/menu-4.svg" alt="menu-3">
                </div>
                <div class="">
                    <img @click="changeView('card')" class="cursor-pointer w-10" :class="{ 'opacity-50 filter-grayscale' : view_type != 'card' }" src="/image/site/menu-5.svg" alt="menu-1">
                </div>
            </div>
            <div class="flex md:hidden items-center">
                <template v-if="anItemIsSelected()">
                  <div v-if="view_type == 'card'">
                      <img @click="changeView('line')" class="cursor-pointer w-8" src="/image/site/menu-4.svg" alt="menu-3">
                  </div>
                  <div v-if="view_type == 'line'">
                      <img @click="changeView('card')" class="cursor-pointer w-8" src="/image/site/menu-6.svg" alt="menu-1">
                  </div>
                </template>
                <div v-else @click="emptySelectedItem">
                    <img @click="changeView('card')" class="cursor-pointer w-6 pl-1" src="/image/site/menu-7.svg" alt="menu-1">
                </div>
            </div>

        </div>
    </div> -->

    <div class="container mt-4" v-if="!all_requests.length">
      <div class="w-full md:w-1/3 mb-4 md:mb-6 bg-white rounded-lg p-6 text-center text-xl font-medium">
        {{ $t('No requests at the moment') }}
      </div>
    </div>

    <!-- Card list - start -->
    <div class="container mt-4 md:mt-6 text-grey-dark hidden md:block">
      <transition-group name="list-complete" tag="div" class="flex flex-wrap -mx-6" v-if="view_type == 'card'">
        <div class="w-full md:w-1/2 lg:w-1/3 mb-4 md:mb-12 px-6 list-complete-item" v-bind:key="item.id"
             v-for="item, item_key in all_requests">
          <div class="bg-white rounded-lg py-4 px-6 shadow h-full flex flex-col justify-between">
            <div>
              <div class="md:text-xl mb-6 text-center">
                <span class="font-bold"> {{ item.room_title }}  - {{ item.entity_title }}</span>
              </div>
              <div class="relative rahco-center mb-6">
                <div class="w-48 md:w-64 absolute z-10 rounded rounded-full rahco-center shadow-md" v-if="isDone(item)"
                     style="height: 14.1rem;width: 14.1rem; background: #ffffffe8;">
                  <img src="/image/site/big-blue-check.svg">
                </div>
                <div
                    class="text-center relative flex justify-center w-64 h-64 mx-auto rounded-full p-10"
                    :class="getCardColorClass(item)"
                    style="height: 14.1rem;width: 14.1rem;"
                    :style="getCardColorStyle(item)"
                >
                  <img :src="item.icon" class="w-48 md:w-64" :alt="item.item_title">
                </div>
              </div>
              <div class="leading-normal px-6">
                <div class="text-xl md:text-2xl font-bold">{{ item.item_title }}</div>
                <div class="font-medium md:text-xl">{{ item.options_string }}</div>
                <!-- <div class="text-right text-sm opacity-25 mt-2">{{ $t(status_titles[item.status_id]) }}</div> -->
              </div>
            </div>
            <div>
              <div class="text-right text-indigo-dark font-bold text-sm mt-4">
                {{ created_at_human_string(item.created_at_human) }} {{ $t("Min") }}
              </div>
              <div class="border-b-2 border-indigo-lightest -mx-6 my-3"></div>
              <div class="flex flex-wrap py-4">
                <button type="button" class="rhc-btn-type-one mb-3"
                        v-if="shareCondition(item)"
                        @click="updateStatus(item.id, 4, item_key)"
                >
                  {{ $t('Share') }}
                  <!-- <img class="absolute pin-r pin-t w-10 h-10" src="/image/site/share.svg" alt="share"> -->
                </button>
                <div type="button" class="rhc-btn-type-one-disabled mb-3" v-else-if="disabledShareCondition(item)">
                  {{ $t('Share') }}
                  <!-- <img class="absolute pin-r pin-t w-10 h-10" src="/image/site/share.svg" alt="share"> -->
                </div>
                <button type="button" class="rhc-btn-type-one"
                        v-if="AcceptCondition(item)"
                        @click="updateStatus(item.id, 1, item_key)"
                >
                  {{ $t('Accept') }}
                  <!-- <img class="absolute pin-r pin-t w-10 h-10" src="/image/site/check.svg" alt="check"> -->
                </button>
                <button type="button" class="rhc-btn-type-one"
                        v-if="doneCondition(item)"
                        @click="updateStatus(item.id, 2, item_key)"
                >
                  {{ $t('Reqeust done') }}
                  <!-- <img class="absolute pin-r pin-t w-10 h-10" src="/image/site/check.svg" alt="check"> -->
                </button>
                <button type="button" class="rhc-btn-type-one"
                        v-if="reopenCondition(item)"
                        @click="updateStatus(item.id, 0, item_key)"
                >
                  {{ $t('Reopen Reqeust') }}
                  <!-- <img class="absolute pin-r pin-t w-10 h-10" src="/image/site/cross.svg" alt="cross"> -->
                </button>
              </div>
            </div>
          </div>
        </div>
      </transition-group>
    </div>
    <!-- Card list - end -->

    <!-- Vertical list - start -->
    <div class="container mb-16 mt-4 md:mt-6 hidden md:block" v-if="view_type == 'line'">
      <transition-group name="flip-list list-complete" class="relative" tag="div">
        <div class="rounded-lg flex mb-4 list-complete-item shadow-sm"
             :class="[reopenCondition(item) || (request_condition_properties(item).bg == 'grey') ? 'bg-grey-light' : 'bg-white']"
             v-if="request_condition_properties(item).visible"
             v-for="item, item_key in all_requests"
             v-bind:key="item.id"
        >
          <div class="init2 mr-4 flex flex-col md:flex-row items-center font-semibold">
            <div class="relative rahco-center h-full">
              <div class="absolute z-10 rahco-center" v-if="isDone(item)">
                <img src="/image/site/big-blue-check.svg" class="p-1 w-20">
              </div>
              <div
                  class="h-full rahco-center rounded-l-lg w-28 px-4"
                  :class="getLineColorClass(item)"
                  :style="getLineColorStyle(item)"
              >
                <img :src="item.icon" class="h-18" :alt="item.item_title" :class="rowDisabledClass(item)">
              </div>
            </div>
            <div class="leading-normal ml-6 text-xl md:text-xl" :class="rowDisabledClass(item)">
              <div>{{ item.room_title }}</div>
              <div>{{ item.entity_title }}</div>
            </div>
          </div>
          <div class="init w-full  py-2 px-3 md:py-4 md:px-6 border-r-2 border-l-2 border-grey-lighter font-semibold"
               :class="rowDisabledClass(item)">
            <div class="leading-tight h-full flex flex-col">
              <div class="flex flex-wrap justify-between">
                <div class="text-xl md:text-2xl">{{ item.item_title }}</div>
                <!-- <div class="text-right text-sm opacity-25 mt-2">{{ $t(status_titles[item.status_id]) }}</div> -->
              </div>
              <div class="md:text-xl">{{ item.options_string }}</div>
              <div class="text-right text-indigo-dark text-base" v-if="!reopenCondition(item)">
                {{ created_at_human_string(item.created_at_human) }} {{ $t("Min") }}
              </div>
            </div>
          </div>
          <div
              class="pull-right  py-2 px-3 md:py-4 md:px-6 flex flex-col md:flex-row justify-end items-center font-medium">
            <div class="text-center m-2" v-if="shareCondition(item) && !is_all">
              <img @click="updateStatus(item.id, 4, item_key)" src="/image/site/teal-share-2.svg" class="cursor-pointer"
                   alt="teal-share">
              <div class="mt-2">{{ $t('Share') }}</div>
            </div>

            <div class="text-center m-2" v-if="AcceptCondition(item)">
              <img @click="updateStatus(item.id, 1, item_key)" src="/image/site/accept.svg" class="cursor-pointer"
                   alt="green-check">
              <div class="mt-2">{{ $t('Accept') }}</div>
            </div>

            <div class="text-center m-2" v-if="doneCondition(item)">
              <img @click="updateStatus(item.id, 2, item_key)" src="/image/site/blue-check.svg" class="cursor-pointer"
                   alt="green-check">
              <div class="mt-2">{{ $t('Done') }}</div>
            </div>

            <div class="text-center m-2" v-if="reopenCondition(item)">
              <img @click="updateStatus(item.id, 0, item_key)" src="/image/site/white-reload.svg" class="cursor-pointer"
                   alt="green-check">
              <div class="mt-2">{{ $t('Reopen') }}</div>
            </div>

            <!-- <div class="w-1/2 text-center filter-grayscale opacity-50" v-else-if="disabledShareCondition(item)">
                <img src="/image/site/teal-share-2.svg" alt="teal-share">
                <div class="mt-2">{{ $t('Share') }}</div>
            </div> -->
          </div>
        </div>
      </transition-group>
    </div>
    <!-- Vertical list - end -->

    <!-- Mobile card list - start -->
    <div class="container mt-4 md:mt-6 text-grey-dark block md:hidden" v-if="view_type == 'card'">

      <!-- selected card display - start -->
      <div class="w-full md:w-1/3 mb-4"
           v-for="item, item_key in all_requests"
           v-if="selected_item.id == item.id"
           v-click-outside=""
      >
        <div class="bg-white rounded-lg py-4 px-6 shadow h-full z-20 flex flex-col justify-between">
          <div>
            <div class="md:text-xl mb-6 flex justify-between">
              <div @click="emptySelectedItem">
                <img class="-m-3 -ml-6 absolute p-3" src="/image/site/arrow.svg" alt="arrow"
                     style="transform: rotate(180deg);">
              </div>
              <div class="font-medium text-xl">{{ item.room_title }} - {{ item.entity_title }}</div>
              <div></div>
            </div>
            <div class="relative rahco-center mb-6">
              <div class="w-48 md:w-64 absolute z-10 rounded rounded-full rahco-center shadow-md" v-if="isDone(item)"
                   style="height: 14.1rem;width: 14.1rem; background: #ffffffe8;">
                <img src="/image/site/big-blue-check.svg">
              </div>
              <div class="text-center relative flex justify-center w-64 h-64 mx-auto rounded-full p-10"
                   :class="getCardColorClass(item)" style="height: 14.1rem;width: 14.1rem;">
                <img :src="item.icon" class="w-48 md:w-64" :alt="item.item_title">
              </div>
            </div>
            <div class="leading-normal px-6">
              <div class="text-xl md:text-2xl font-bold">{{ item.item_title }}</div>
              <div class="md:text-xl">{{ item.options_string }}</div>
              <!-- <div class="text-right text-sm opacity-25 mt-2">{{ $t(status_titles[item.status_id]) }}</div> -->
            </div>
          </div>
          <div>
            <div class="text-right text-indigo-dark font-bold text-sm mt-4">
              {{ created_at_human_string(item.created_at_human) }} {{ $t("Min") }}
            </div>
            <div class="border-b-2 border-indigo-lightest -mx-6 my-3"></div>
            <div class="flex flex-wrap py-4">
              <button type="button" class="rhc-btn-type-one mb-3"
                      v-if="AcceptCondition(item)"
                      @click="updateStatus(item.id, 1, item_key)"
              >
                {{ $t('Accept') }}
                <!-- <img class="absolute pin-r pin-t w-10 h-10" src="/image/site/check.svg" alt="check"> -->
              </button>
              <button type="button" class="rhc-btn-type-one mb-3"
                      v-if="doneCondition(item)"
                      @click="updateStatus(item.id, 2, item_key)"
              >
                {{ $t('Reqeust done') }}
                <!-- <img class="absolute pin-r pin-t w-10 h-10" src="/image/site/check.svg" alt="check"> -->
              </button>
              <button type="button" class="rhc-btn-type-one mb-3"
                      v-if="reopenCondition(item)"
                      @click="updateStatus(item.id, 0, item_key)"
              >
                {{ $t('Reopen Reqeust') }}
                <img class="absolute pin-r pin-t w-10 h-10" src="/image/site/cross.svg" alt="cross">
              </button>
              <button type="button" class="rhc-btn-type-one"
                      v-if="shareCondition(item)"
                      @click="updateStatus(item.id, 4, item_key)"
              >
                {{ $t('Share') }}
                <!-- <img class="absolute pin-r pin-t w-10 h-10" src="/image/site/share.svg" alt="share"> -->
              </button>
              <div type="button" class="rhc-btn-type-one-disabled" v-else-if="disabledShareCondition(item)">
                {{ $t('Share') }}
                <!-- <img class="absolute pin-r pin-t w-10 h-10" src="/image/site/share.svg" alt="share"> -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- selected card display - end -->

      <transition-group name="list-complete" tag="div" class="flex flex-wrap -mx-2" v-if="anItemIsSelected()">
        <div class="w-1/2 mb-4 md:mb-12 px-2 list-complete-item"
             v-for="item, item_key in all_requests"
             v-bind:key="item.id"
             @click="selectRequsetItem(item)"
        >
          <div class="rounded-lg py-4 px-3 shadow h-full border-2 cursor-pointer flex flex-col justify-between"
               :class="[selected_item_id == item.id ? 'border-teal-light' : '', isDone(item) ? 'bg-grey-light border-grey-light' : 'bg-white border-white']"
          >
            <div class="font-medium text-xl" :class="{'opacity-50' : isDone(item)}">
              <div class="mb-6">{{ item.room_title }} <br> {{ item.entity_title }}</div>
              <!-- <div class="text-right text-xs opacity-25 mt-2">{{ $t(status_titles[item.status_id]) }}</div> -->

              <div class="leading-normal font-semibold">
                <div class="flex flex-wrap justify-between items-center">
                  <div class="">{{ item.item_title }}</div>
                </div>
                <div class="text-xs">{{ item.options_string }}</div>
              </div>
            </div>

            <div class="flex flex-wrap justify-between items-end mt-3">
              <div class="relative flex flex-wrap justify-between relative w-full">
                <div class="absolute z-10 rounded rounded-full rahco-center shadow-md w-24 h-24" v-if="isDone(item)"
                     style="background: #ffffffe8;">
                  <img src="/image/site/big-blue-check.svg" class="w-12">
                </div>
                <div class="text-center relative flex justify-center rounded-full p-4 w-24 h-24"
                     :class="getCardColorClass(item)">
                  <img :src="item.icon" class="w-48 md:w-64" :alt="item.item_title">
                </div>
                <div class="text-right text-indigo-dark font-bold text-xs mt-auto flex-1 font-bold"
                     :class="{'opacity-50' : isDone(item)}">
                  {{ created_at_human_string(item.created_at_human) }} {{ $t("Min") }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </transition-group>

    </div>
    <!-- Mobile card list - end -->

    <!-- Mobile Vertical list - start -->
    <div class="container mb-16 mt-4 md:mt-6 block md:hidden" v-if="view_type == 'line'">
      <transition-group name="flip-list list-complete" class="relative" tag="div">
        <div class="rounded-lg flex mb-4 list-complete-item"
             :class="[reopenCondition(item) || (request_condition_properties(item).bg == 'grey') ? 'bg-grey-light' : 'bg-white']"
             v-if="request_condition_properties(item).visible"
             v-for="item, item_key in all_requests"
             v-bind:key="item.id"
             style="min-height: 88px;"
        >
          <div
              class="w-1/5 flex flex-col md:flex-row items-center py-2 md:py-4 md:px-6 font-semibold rounded-l-lg justify-center"
              :class="getLineColorClass(item)"
              :style="getLineColorStyle(item)"
          >
            <div class="relative rahco-center">
              <div class="absolute z-10 rounded rounded-full rahco-center w-10 h-10" v-if="isDone(item)">
                <img src="/image/site/white-check.svg" class="w-10">
              </div>
              <div class="text-center relative flex justify-center mx-auto rounded-full md:p-2 p-1 h-14 w-12"
                   :class="getLineColorClass(item)">
                <img :src="item.icon" class="w-48 md:w-64" :class="rowDisabledClass(item)" :alt="item.item_title">
              </div>
            </div>
            <!-- <div class="text-right text-xs opacity-25 mt-2">{{ $t(status_titles[item.status_id]) }}</div> -->
          </div>
          <div class="w-3/5 py-2 px-3 md:py-4 md:px-6 border-l-2 border-grey-lighter font-semibold"
               :class="rowDisabledClass(item)">
            <div class="leading-tight h-full flex flex-col">
              <div class="flex flex-row text-sm">
                <div class="mr-3">{{ item.room_title }}</div>
                <div>{{ item.entity_title }}</div>
              </div>
              <div class="text-xl md:text-2xl">{{ item.item_title }}</div>
              <div class="md:text-xl">{{ item.options_string }}</div>
              <div class="text-indigo-dark text-xs mt-3 leading-normal" v-if="!reopenCondition(item)"
                   :class="rowDisabledClass(item)">{{ created_at_human_string(item.created_at_human) }} {{ $t("Min") }}
              </div>
            </div>
          </div>
          <div
              class="w-2/5 p-1 md:py-4 md:px-6 flex flex-row justify-end items-end md:items-center font-medium text-xs">
            <div class="w-1/2 text-center" v-if="shareCondition(item) && !is_all">
              <img @click="updateStatus(item.id, 4, item_key)" src="/image/site/teal-share-2.svg"
                   class="cursor-pointer w-8" alt="teal-share">
              <div class="mt-1 md:mt-4 text-ellipsis">{{ $t('Share') }}</div>
            </div>

            <div class="w-1/2 text-center" v-if="AcceptCondition(item)">
              <img @click="updateStatus(item.id, 1, item_key)" src="/image/site/accept.svg" class="cursor-pointer w-8"
                   alt="green-check">
              <div class="mt-1 md:mt-4 text-ellipsis">{{ $t('Accept') }}</div>
            </div>

            <div class="w-1/2 text-center" v-if="doneCondition(item)">
              <img @click="updateStatus(item.id, 2, item_key)" src="/image/site/blue-check.svg"
                   class="cursor-pointer w-8" alt="green-check">
              <div class="mt-1 md:mt-4 text-ellipsis">{{ $t('Done') }}</div>
            </div>

            <div class="w-1/2 text-center" v-if="reopenCondition(item)">
              <img @click="updateStatus(item.id, 0, item_key)" src="/image/site/white-reload.svg"
                   class="cursor-pointer w-8" alt="green-check">
              <div class="mt-1 md:mt-4 text-ellipsis">{{ $t('Reopen') }}</div>
            </div>

            <!-- <div class="w-1/2 text-center filter-grayscale opacity-50" v-else-if="disabledShareCondition(item)">
                <img src="/image/site/teal-share-2.svg" class="w-8" alt="teal-share">
                <div class="mt-1 md:mt-4 text-ellipsis">{{ $t('Share') }}</div>
            </div> -->
          </div>
        </div>
      </transition-group>
    </div>
    <!-- Mobile Vertical list - end -->

    <audio ref="notification_1" src="/sound/notification_1.mp3" preload="auto"></audio>
    <audio ref="notification_4" src="/sound/notification_4.wav" preload="auto"></audio>
    <audio ref="blank_voice" src="/sound/blank.mp3" preload="auto" autoplay loop></audio>
    <audio ref="reminder_voice" src="/sound/reminder.wav" preload="auto"></audio>
    <audio ref="post_accept_reminder_voice" src="/sound/done-reminder.mp3" preload="auto"></audio>

    <modal name="page_refresh_modal" :width="400" :height="250" :adaptive="true" classes="p-4 py-6 text-white"
           @closed="playBlankVoice">
      <div class="flex flex-col justify-between p-8 h-full bg-indigo-dark text-white rounded-lg">
        <div class="text-center leading-normal font-semibold">
          {{ $t('Refresh Message') }}
        </div>
        <div class="flex justify-between items-end h-full">
          <button type="button" class="dialog-btn-type-one active font-medium" @click="playBlankVoice">{{
              $t('Continue')
            }}
          </button>
        </div>
      </div>
    </modal>

  </div>

</template>

<script>
import ClickOutside from 'vue-click-outside'

export default {
  props: ['request_items', 'is_all', 'active_entities_id', 'available_beds_id', 'refreshed', 'is_desktop', 'browser'],

  data() {


    return {
      view_type: this.$cookie.get('view_type') ? this.$cookie.get('view_type') : 'line',
      all_requests: this.request_items,
      selected_item: {},
      selected_item_id: null,
      component_key: 0,
      reminder_index: 1,
      directlyIsFlutterInAppWebViewIosReadyDirectly: false,

    }
  },

  methods: {
    handleFlutterEvent(payload) {
      if (payload.data) {
        this.directlyIsFlutterInAppWebViewIosReadyDirectly = true
      }
    },
    changeView(type = 'card') {
      this.view_type = type
      this.$cookie.set('view_type', type, 7)
    },

    updateStatus(item_id, status, item_key) {
      this.selected_item = {}

      let endpoint = genrateAddress('request_items/' + item_id)
      let data = {'status': status}

      axios.put(endpoint, data)
          .then(function (response) {

            if (response.data.data.updateStatus == true) {

              this.all_requests[item_key].status_id = status
              this.reload()
            }
            if (response.data.data.flash == true) {

              flash(response.data.data.flashMessage, 'success')
            }

          }.bind(this))
          .catch(function (error) {
            // flash('Error', 'error')
          });
    },

    reload() {
      let endpoint = this.is_all == '1' ? 'requests' : 'my_requests'

      axios.get(genrateAddress(endpoint))
          .then(function (response) {
            this.all_requests = response.data.data
          }.bind(this))
          .catch(function (error) {
            // flash('Error', 'error')
          });
    },

    rowDisabledClass(item) {
      return [2, 3].includes(item.status_id) ? 'opacity-50' : ''
    },

    AcceptCondition(item) {
      return [0, 4].includes(item.status_id)
    },

    doneCondition(item) {
      return [1].includes(item.status_id)
    },

    reopenCondition(item) {
      return [2, 3].includes(item.status_id)
    },

    shareCondition(item) {
      return [0, 1].includes(item.status_id)
    },

    disabledShareCondition(item) {
      return [2, 4].includes(item.status_id)
    },

    isDone(item) {
      return [2].includes(item.status_id)
    },

    selectRequsetItem(item) {
      this.selected_item = item
      this.selected_item_id = item.id
    },

    emptySelectedItem() {
      this.selected_item = {}
    },

    reset() {
      this.selected_item = {}
    },

    playNotification(type = 1, item) {
      if (window.App.settings.voice == true && this.request_condition_properties(item).voice) {
        if (type == 4) {
          if (!this.directlyIsFlutterInAppWebViewIosReadyDirectly) {


            this.$refs.notification_4.play() // new request sound
          }
        } else {
          if (!this.directlyIsFlutterInAppWebViewIosReadyDirectly) {

            this.$refs.notification_1.play() // request share sound
          }
        }
      }
      // if (window.App.settings.vibration == true) {
      //   this.vibrate()
      // }
    },

    updateNotAllowed(item) {

      if (!this.is_all) {
        if (window.App.departments_id.indexOf(item.department_id) == -1) {

          return true;
        } else {

          return this.active_entities_id.indexOf(item.entity_id) == -1
              && window.App.active_types_id.indexOf(item.service_type_id) == -1;
        }

      }
      return this.available_beds_id.indexOf(item.entity_id) == -1;
    },

    newRequestEvent() {
      var channel_one = Echo.channel(`request.tenant_${window.App.domain_id}`);

      channel_one.listen('.new-request-event', function (data) {
        data.request_items.forEach(function (item) {

          if (this.updateNotAllowed(item)) {
            return;
          }

          this.reload()
          // let index = _.findLastIndex(this.all_requests, { 'status_id': 4 }); // find top of done items index
          // this.all_requests.splice(index + 1, 0, item)
          // flash("New Request")
          this.playNotification(1, item)
          this.reminder_index = 0
        }.bind(this))
      }.bind(this));
    },

    requestItemUpdateEvent() {
      var channel_two = Echo.channel(`request-item-update.tenant_${window.App.domain_id}`);

      channel_two.listen('.request-item-update-event', function (data) {
        data.request_items.forEach(function (item) {
          if (this.updateNotAllowed(item)) {
            return;
          }
          this.reload() // reorder items
          if (item.status_id == 4) {
            // flash("Request Updated")
            this.playNotification(4, item)
          }
        }.bind(this))
      }.bind(this));
    },

    requestItemDeleteEvent() {
      var channel_three = Echo.channel(`request-item-delete.tenant_${window.App.domain_id}`);
      channel_three.listen('.request-item-delete-event', function (data) {
        data.request_items.forEach(function (item) {
          if (this.updateNotAllowed(item)) {
            return;
          }
          this.reload() // reorder items
        }.bind(this))
      }.bind(this));
    },

    anItemIsSelected() {
      return Object.keys(this.selected_item).length === 0
    },

    created_at_human_string(minutes) {
      return minutes + ' '
    },

    playBlankVoice() {
      console.log('playBlankVoice')
      if (!$isFlutterInAppWebViewReadyDirectly) {
        let audio = this.$refs.blank_voice;
        audio.play();
        this.$modal.hide('page_refresh_modal');

        this.openAudioChannelIos()
      }
    },

    handleVoiceDialog() {
      setTimeout(() => {
        let show_voice_dialog = this.isBlankVoicePaused && (this.is_desktop == false || this.browser == "Safari")
        if (show_voice_dialog) {
          if (!$isFlutterInAppWebViewReadyDirectly) {

            this.$modal.show('page_refresh_modal');
          }
        }
      }, 1000);
    },

    openAudioChannelIos() {
      this.$refs.notification_1.play()
      this.$refs.notification_1.pause()
      this.$refs.notification_4.play()
      this.$refs.notification_4.pause()
      this.$refs.reminder_voice.play()
      this.$refs.reminder_voice.pause()
      this.$refs.post_accept_reminder_voice.play()
      this.$refs.post_accept_reminder_voice.pause()
    },

    getCardColorClass(item) {
      return [
        {'bg-teal-lighter': item.status_id == 4},
        {'shadow-md': this.isDone(item)}
      ]
    },

    getCardColorStyle(item) {
      let color = item.type != null ? item.type.color : '';
      let bg_style = 'background-color: ' + color + ';'
      return item.status_id != 4 ? bg_style : ''
    },

    getLineColorClass(item) {
      return [
        {'bg-teal-lighter': item.status_id == 4},
        {'bg-grey-1': this.isDone(item)}
      ]
    },

    getLineColorStyle(item) {
      let color = item.type != null ? item.type.color : '';
      let bg_style = 'background-color: ' + color
      return item.status_id != 4 && !this.isDone(item) ? bg_style : ''
    },

    vibrate() {
      window.navigator.vibrate([300, 100, 200, 50, 300]);
    },

    // Handel Request Submission -- Start
    hasOnlineStaff(item) {
      let users = window.App.online_users;
      // console.log('all online users - bed & type scope');  // temp
      // console.log(users);  // temp
      users = _.filter(users, function (user) {
        if (user.id == window.App.user_id) {
          return false
        }
        return _.includes(user.active_beds_id, item.entity_id) || _.includes(user.active_types_id, item.service_type_id);
      })
      // console.log('filtered online users - bed & type scope');  // temp
      // console.log(users);  // temp
      return users.length > 0;
    },

    // Handel Request Submission -- Start
    hasOnlineStaffTypeScope(item) {
      let users = window.App.online_users;
      users = _.filter(users, function (user) {
        if (user.id == window.App.user_id) {
          return false
        }
        // console.log('user active types id');  // temp
        // console.log(user.active_types_id);  // temp
        return _.includes(user.active_types_id, item.service_type_id);
      })
      // console.log('filtered online users - type scope');  // temp
      // console.log(users);  // temp
      return users.length > 0;
    },

    bedIsSelected(item) {
      return _.includes(item.bed_owners, window.App.user_id)
    },

    typeIsSelected(item) {
      return _.includes(window.App.active_types_id, item.service_type_id) ?? false
    },

    itemConditions(item) {
      return {
        'nobody_selected_bed_and_type_online': !this.hasOnlineStaff(item),
        'nobody_selected_type_online': !this.hasOnlineStaffTypeScope(item),
        'bed_is_selected': this.bedIsSelected(item),
        'type_is_selected': this.typeIsSelected(item),
        'is_global_service': item.is_global_service,
      }
    },

    firstItemConditionGroupCheck(conditions) {
      let result = (conditions.bed_is_selected && conditions.type_is_selected) ||
          (conditions.bed_is_selected && !conditions.type_is_selected && conditions.nobody_selected_bed_and_type_online) ||
          (!conditions.bed_is_selected && conditions.type_is_selected && conditions.is_global_service) ||
          (!conditions.bed_is_selected && conditions.type_is_selected && !conditions.is_global_service && conditions.nobody_selected_bed_and_type_online);

      return result;
    },

    secondItemConditionGroupCheck(conditions) {
      let result = (conditions.bed_is_selected && !conditions.type_is_selected && (!conditions.nobody_selected_bed_and_type_online && !conditions.nobody_selected_type_online));

      return result;
    },

    thirdItemConditionGroupCheck(conditions) {
      let result = (!conditions.bed_is_selected && conditions.type_is_selected && !conditions.is_global_service && !conditions.nobody_selected_bed_and_type_online);
      return result;
    },

    request_condition_properties(item) {
      let conditions = this.itemConditions(item)

      // console.log(item.id + ' - ' + item.item_title) // temp
      // console.log(conditions) // temp

      let first_condition_group = this.firstItemConditionGroupCheck(conditions);
      let second_condition_group = this.secondItemConditionGroupCheck(conditions);
      let third_condition_group = this.thirdItemConditionGroupCheck(conditions);

      let state_one = {bg: 'white', voice: true, visible: true};
      let state_two = {bg: 'grey', voice: false, visible: true};
      let state_three = {bg: 'grey', voice: false, visible: false};

      if (this.is_all) {
        return state_one;
      }

      if (third_condition_group) {
        return state_three;
      }

      if (second_condition_group) {
        return state_two;
      }

      if (first_condition_group) {
        return state_one;
      }


      // console.log('* There is no condition match. *') // temp
      return state_one;
    },

    joinChannel() {
      window.Echo.join(`hospital.${window.App.domain_id}`)
          .here((users) => {
            this.reload()
          })
          .joining((user) => {
            // console.log('joining forceRerender') // temp
            this.forceRerender()
          })
          .leaving((user) => {
            // console.log('leaving forceRerender') // temp
            this.forceRerender()
          });
    },

    forceRerender() {
      this.component_key += 1;
    },

    reminderHandler() {
      if (window.App.settings.voice == true && this.reminder_index > 0) {
        var BreakException = {};

        try {
          this.all_requests.forEach(function (item) {
            let conditions = this.itemConditions(item)
            // make status as const variables - temp
            if (this.request_condition_properties(item).bg == 'white' && this.AcceptCondition(item)) {
              this.$refs.reminder_voice.play();
              throw BreakException
            }
            ;
          }.bind(this));
        } catch (e) {
          if (e !== BreakException) throw e;
        }
      }
      this.reminder_index = 1
    },

    postAcceptReminderHandler() {
      if (window.App.settings.voice == true && this.reminder_index > 0) {
        var BreakException = {};

        try {
          this.all_requests.forEach(function (item) {
            let conditions = this.itemConditions(item)
            // make status as const variables - temp
            //   console.log(item);
            //   console.log('time item:');
            //   console.log(item.updated_at_human);
            if (this.request_condition_properties(item).bg == 'white' && this.doneCondition(item) && item.updated_at_human >= 14) {
              this.$refs.post_accept_reminder_voice.play();
              throw BreakException
            }

            // if (this.request_condition_properties(item).bg == 'white' && this.reopenCondition(item) && item.updated_at_human >= 14) {
            //   this.$refs.post_accept_reminder_voice.play();
            //   throw BreakException
            // }
            ;
          }.bind(this));
        } catch (e) {
          if (e !== BreakException) throw e;
        }
      }
      this.reminder_index = 1
    }

  },
  // Handel Request Submission -- End

  computed: {
    status_titles() {
      return {
        '0': 'Pending',
        '1': 'Accepted',
        '2': 'Done',
        '3': 'Canceled',
        '4': 'Shared',
      }
    },

    beds_count() {
      return Object.keys(_.groupBy(this.undone_request, 'entity_id')).length;
    },

    undone_request() {
      return _.filter(this.all_requests, function (item) {
        if (item.status_id != 2) return item
      });
    },
    isBlankVoicePaused() {
      return this.$refs.blank_voice.paused;
    }

  },


  directives: {
    ClickOutside
  },
  updated() {
    var minWidth = $('div.init').width();
    $('div.init').each(function () {
      $(this).width();
      if (minWidth > $(this).width()) {
        minWidth = $(this).width()
      }
    });
    $('div.init').each(function () {
      $(this).width(minWidth);
    });
    var maxWidth = 0;
    $('div.init2').each(function () {
      $(this).width();
      if (maxWidth < $(this).width()) {
        maxWidth = $(this).width()
      }
    });
    $('div.init2').each(function () {
      $(this).width(maxWidth);
    });
  },
  created() {
    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    this.newRequestEvent()
    this.requestItemUpdateEvent()
    this.requestItemDeleteEvent()
    this.joinChannel()
    this.forceRerender()


  },

  mounted() {

    window.events.$on('directlyIsFlutterInAppWebViewIosReadyDirectlyEvent', this.handleFlutterEvent);

    document.addEventListener('click', this.playBlankVoice)

    setInterval(function () {
      this.all_requests.forEach(function (item) {
        item.created_at_human++
      });
    }.bind(this), 1000 * 60);

    this.$nextTick(function () {
      this.handleVoiceDialog()
    })

    setInterval(function () {
      this.reminderHandler()
      this.postAcceptReminderHandler()
    }.bind(this), 1000 * 60 * window.App.reminder_period);

    setInterval(function () {
      try {
        this.all_requests.forEach(function (item) {
          item.updated_at_human = item.updated_at_human + 1
        }.bind(this));
      } catch (e) {
        if (e !== BreakException) throw e;
      }
    }.bind(this), 1000 * 60);

  }
}
</script>
