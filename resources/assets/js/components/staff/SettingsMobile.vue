<template>
  <div class="unselectable">
    <!-- <div class="container">
        <div class="rounded-lg bg-white flex flex-wrap p-4 py-6 mt-4 justify-between">
            <div class="flex items-center">
                <img src="/image/site/settings-gears.svg" class="h-10 w-10 mr-3" alt="users">
                <div class="leading-tight">
                    <div class="text-xl text-black capitalize">{{ $t(active_menu) }}</div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="container mt-4" v-if="active_menu == 'Settings'">
      <div class="p-6 border-2 bg-white w-full mb-4 flex cursor-pointer flex justify-between border-indigo-lightest"
           @click="active_menu = 'Account'">
        <div class="w-1/6 flex justify-center items-center">
          <img src="/image/site/simple-user.svg" class="w-6 h-6" alt="user">
        </div>
        <div class="flex items-center justify-between w-full">
          <div class="font-bold cursor-pointer">{{ $t('Account') }}</div>
          <div>{{ user.name + ' ' + user.family }}</div>
        </div>
      </div>
      <div class="p-6 border-2 bg-white w-full mb-4 flex cursor-pointer flex justify-between border-indigo-lightest"
           @click="active_menu = 'Type'">
        <div class="w-1/6 flex justify-center items-center">
          <img src="/image/site/simple-user.svg" class="w-6 h-6" alt="simple-user">
        </div>
        <div class="flex items-center justify-between w-full">
          <div class="font-bold cursor-pointer">{{ $t('Types') }}</div>
          <div class="flex-no-wrap overflow-hidden text-ellipsis pl-10">
            {{ active_types_string }}
          </div>
        </div>
      </div>
      <div class="p-6 border-2 bg-white w-full mb-4 flex cursor-pointer flex justify-between border-indigo-lightest"
           @click="active_menu = 'language'">
        <div class="w-1/6 flex justify-center items-center">
          <img src="/image/site/language.svg" class="w-6 h-6" alt="language">
        </div>
        <div class="flex items-center justify-between w-full">
          <div class="font-bold cursor-pointer">{{ $t('Language') }}</div>
          <div v-for="lang in languages" v-if="lang.id == active_lang.id" class="capitalize">{{ lang.title }}</div>
        </div>
      </div>
      <div class="p-6 border-2 bg-white w-full mb-4 flex cursor-pointer flex justify-between border-indigo-lightest">
        <div class="w-1/6 flex justify-center items-center">
          <img src="/image/site/notification.svg" class="w-6 h-6" alt="notification">
        </div>
        <div class="flex items-center justify-between w-full">
          <label class="font-bold cursor-pointer" for="notification-mobile">{{ $t('Notification') }}</label>
          <div>
            <div class="form-switch -my-2">
              <input type="checkbox" name="notification" id="notification-mobile" value="true"
                     class="form-switch-checkbox" v-model="notification">
              <label for="notification-mobile" class="form-switch-label"></label>
            </div>
          </div>
        </div>
      </div>
      <div class="p-6 border-2 bg-white w-full mb-4 flex cursor-pointer flex justify-between border-indigo-lightest">
        <div class="w-1/6 flex justify-center items-center">
          <img src="/image/site/voice.svg" class="w-6 h-6" alt="voice">
        </div>
        <div class="flex items-center justify-between w-full">
          <label class="font-bold cursor-pointer" for="voice-mobile">{{ $t('Tons') }}</label>
          <div>
            <div class="form-switch -my-2">
              <input type="checkbox" name="voice" id="voice-mobile" class="form-switch-checkbox" v-model="voice">
              <label for="voice-mobile" class="form-switch-label"></label>
            </div>
          </div>
        </div>
      </div>
      <div class="p-6 border-2 bg-white w-full mb-4 flex cursor-pointer flex justify-between border-indigo-lightest">
        <div class="w-1/6 flex justify-center items-center">
          <img src="/image/site/pause.svg" class="w-6 h-6" alt="pause">
        </div>
        <div class="flex items-center justify-between w-full">
          <label class="font-bold cursor-pointer" for="pause-mobile">{{ $t('Break') }}</label>
          <div>
            <div class="form-switch -my-2">
              <input type="checkbox" name="pause" id="pause-mobile" class="form-switch-checkbox" v-model="pause">
              <label for="pause-mobile" class="form-switch-label"></label>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="p-6 border-2 bg-white w-full mb-4 flex cursor-pointer flex justify-between border-indigo-lightest">
          <div class="w-1/6 flex justify-center items-center">
              <img src="/image/site/vibration.svg" class="w-6 h-6" alt="vibration">
          </div>
          <div class="flex items-center justify-between w-full">
            <label class="font-bold cursor-pointer" for="vibration-mobile">{{ $t('Vibration') }}</label>
              <div>
                  <div class="form-switch -my-2">
                      <input type="checkbox" name="vibration" id="vibration-mobile" class="form-switch-checkbox" v-model="vibration">
                      <label for="vibration-mobile" class="form-switch-label"></label>
                  </div>
              </div>
          </div>
      </div> -->
      <!-- <div class="p-6 border-2 bg-white w-full mb-4 flex cursor-pointer flex justify-between border-indigo-lightest">
          <div class="w-1/6 flex justify-center items-center">
              <img src="/image/site/help.svg" class="w-6 h-6" alt="help">
          </div>
          <div class="flex items-center justify-between w-full">
              <div class="font-bold cursor-pointer">{{ $t('Help') }}</div>
              <div>{{ $t('Ask?') }}</div>
          </div>
      </div> -->
      <!-- <div class="p-6 border-2 bg-white w-full mb-4 flex cursor-pointer flex justify-between border-indigo-lightest">
          <div class="w-1/6 flex justify-center items-center">
              <img src="/image/site/notification.svg" class="w-6 h-6" alt="notification">
          </div>
          <div class="flex items-center justify-between w-full">
            <label class="font-bold cursor-pointer" for="notification-mobile">
              <web-push></web-push>
            </label>
          </div>
      </div> -->
    </div>

    <div class="container mt-4">
      <div class="w-full -mb-2" v-if="active_menu == 'language'">
        <div v-for="language in languages"
             class="p-6 border-2 bg-white w-full mb-4 flex cursor-pointer flex justify-between"
             :class="[language.id == active_lang.id ? 'border-indigo-dark' : 'border-indigo-lightest']"
             @click="setLanguage(language)"
        >
          <div class="flex items-center">
            <img :src="language.icon" class="w-6 h-6 mr-3" :alt="language.title">
            {{ language.title }}
          </div>
          <img src="/image/site/simple-check.svg" alt="check" v-if="language.id == active_lang.id">
        </div>
        <br>
      </div>

      <div class="w-full -mb-2" v-if="active_menu == 'Type'">
        <input type="checkbox"
               v-model="active_types[type.id]"
               :key="type.id"
               :id="type.name + type.id"
               v-for="type in types"
               class="hidden"
               :disabled="checkTypeInputDisable(type)"
        >

        <label
            v-for="type in types"
            class="p-6 border-2 bg-white w-full mb-4 flex cursor-pointer flex justify-between"
            :class="[active_types[type.id] == true ? 'border-indigo-dark' : 'border-indigo-lightest']"
            :for="type.name + type.id"
            @click="checkSingleTypeNotification(type)"
        >
          <div class="flex items-center">
            <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" width="9.946" height="12.297"
                 viewBox="0 0 9.946 12.297">
              <g transform="translate(-121.371 -178.262)">
                <g transform="translate(121.371 178.262)">
                  <path
                      d="M9.946,302.831v2.034a.277.277,0,0,1-.291.261H.291A.277.277,0,0,1,0,304.865v-2.034a3.6,3.6,0,0,1,3.778-3.39H6.169a4.111,4.111,0,0,1,1.662.345,3.378,3.378,0,0,1,2.116,3.045Z"
                      transform="translate(0 -292.829)" :fill="type.color"/>
                  <path
                      d="M191.716,313.682V315.7a.277.277,0,0,1-.291.259h-3.2a5.042,5.042,0,0,0,1.377-5.3A3.353,3.353,0,0,1,191.716,313.682Z"
                      transform="translate(-181.77 -303.664)" :fill="type.color"/>
                  <path d="M67.01,109.486a2.872,2.872,0,1,1-1.089-2.252A2.872,2.872,0,0,1,67.01,109.486Z"
                        transform="translate(-59.164 -106.613)" :fill="type.color"/>
                  <path
                      d="M104.227,126.965a2.873,2.873,0,0,1-4.423,2.418,5.778,5.778,0,0,0,3.334-4.67A2.867,2.867,0,0,1,104.227,126.965Z"
                      transform="translate(-96.382 -124.092)" :fill="type.color"/>
                </g>
              </g>
            </svg>
            <span class="ml-6">{{ type.name }}</span>
          </div>
          <img v-if="active_types[type.id] == true" src="/image/site/simple-check.svg" alt="check">
        </label>
        <br>
      </div>

      <div class="w-full flex flex-wrap items-center justify-center">
        <div class="bg-white rounded-lg w-full" v-if="active_menu == 'Account'">
          <div class="p-6 px-8" style="min-height: 240px;">
            <div class="flex flex-wrap justify-between" v-if="!account_edit">
              <div>
                <div class="font-bold text-xl">{{ user.name + ' ' + user.family }}</div>
                <div>{{ user.email }}</div>
                <div>{{ user.username }}</div>
              </div>
              <div class="w-24">
                <img :src="user.avatar" alt="avatar">
              </div>
              <div class="font-bold mt-8 w-full">{{ $t('Here you can change your name.') }}</div>
            </div>
            <div v-else class="text-grey-dark">
              <input type="text" class="border-2 mb-2 outline-none p-4 py-3 rounded-full w-full"
                     :placeholder="$t('name')" v-model="user.name">
              <input type="text" class="border-2 mb-2 outline-none p-4 py-3 rounded-full w-full"
                     :placeholder="$t('family')" v-model="user.family">
              <!-- <input type="text" class="border-2 mb-2 outline-none p-4 py-3 rounded-full w-full" :placeholder="$t('username')" v-model="user.username" disabled> -->
            </div>
          </div>
          <div class="border-t-2 border-grey-lighter p-6 px-8" @click="account_edit = true">
            <div class="cursor-pointer" v-if="!account_edit">
              <img src="/image/site/pen.svg" alt="edit" class="align-text-top h-4 w-4 mr-2">{{ $t('Edit') }}
            </div>
            <div class="cursor-pointer" @click="updateUser" v-else>
              <img src="/image/site/pen.svg" alt="submit" class="align-text-top h-4 w-4 mr-2">{{ $t('Submit') }}
            </div>
          </div>
        </div>
        <div class="flex flex-wrap justify-between">
          <div class="w-full my-8" v-if="active_menu == 'Settings'">
            <div
                class="text-sm bg-white block no-underline no-underline p-3 rounded-full text-center hover:text-indigo-dark hover:bg-white w-48 bg-indigo-dark text-white border-2 border-indigo-dark mx-auto cursor-pointer font-medium"
                @click="showLogoutDialog()">{{ $t('Logout') }}
            </div>
          </div>

          <div class="w-full my-8"
               v-if="active_menu == 'Settings'&& (directlyIsFlutterInAppWebViewReadyDirectly === true)">
            <div
                class="text-sm bg-white block no-underline no-underline p-3 rounded-full text-center hover:text-indigo-dark hover:bg-white w-48 bg-indigo-dark text-white border-2 border-indigo-dark mx-auto cursor-pointer font-medium"
                @click="getHospitalList()">{{ $t('Logout Hospital') }}
            </div>
          </div>
          <div class="w-full mt-8" v-if="active_menu != 'Settings'">
            <div
                class="text-sm bg-white block no-underline no-underline p-3 rounded-full text-center hover:text-indigo-dark hover:bg-white w-48 bg-indigo-dark text-white border-2 border-indigo-dark mx-auto cursor-pointer font-medium"
                @click="active_menu = 'Settings'">{{ $t('Back') }}
            </div>
          </div>
        </div>

      </div>
    </div>

    <modal name="logout_modal" :width="400" :height="230" :adaptive="true" classes="p-4 py-6 text-white">
      <div class="flex flex-col justify-between p-8 h-full bg-indigo-dark text-white rounded-lg">
        <div class="text-center leading-normal font-semibold">
          {{ $t('Do you really want to unsubscribe?') }}
        </div>
        <div class="flex justify-between items-end h-full">
          <button type="button" class="dialog-btn-type-one font-medium" @click="$modal.hide('logout_modal')">
            {{ $t('Cancel') }}
          </button>
          <button type="button" class="dialog-btn-type-one active font-medium" @click="logout()">{{
              $t('Confirm')
            }}
          </button>
        </div>
      </div>
    </modal>
  </div>
</template>

<script>
import SettingsMixin from './SettingsMixin'

export default {
  mixins: [SettingsMixin],

  data() {
    return {
      'active_menu': "Settings",
      directlyIsFlutterInAppWebViewReadyDirectly: false,
    }
  },

  mounted() {
    window.events.$on('directlyIsFlutterInAppWebViewReadyDirectlyEvent', this.handleFlutterEvent);

  },
  methods: {
    handleFlutterEvent(payload) {
      if (payload.data){
        this.directlyIsFlutterInAppWebViewReadyDirectly = true
      }
    }
  }
}
</script>