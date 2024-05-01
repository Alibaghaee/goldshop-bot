<template>
  <div class="unselectable">
    <!-- <div class="container">
        <div class="rounded-lg flex flex-wrap p-4 py-3 md:px-8 mt-4 md:mt-8 justify-between">
            <div class="flex items-center">
                <img src="/image/site/settings-gears.svg" class="h-10 w-10 md:h-16 md:w-16 mr-3 md:mr-6" alt="users">
                <div class="leading-tight font-medium">
                    <div class="text-xl md:text-4xl text-black">{{ $t('Settings') }}</div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="container">
        <div class="bg-white rounded-lg flex flex-wrap mt-4 md:mt-6">
            <div class="w-full md:w-1/2 p-6 md:px-12">
                <div class="flex" @click="active_menu = 'Account'">
                    <div class="w-1/6 flex justify-center items-center">
                        <img src="/image/site/simple-user.svg" class="w-6 h-6" alt="user">
                    </div>
                    <div class="w-5/6 py-8 flex justify-between border-b-2 border-grey-lighter">
                        <div class="font-bold cursor-pointer">{{ $t('Account') }}</div>
                        <div><!-- {{ user.name + ' ' + user.family }} --> {{ user.room.title }} : {{ user.title }}</div>
                    </div>
                </div>
                <div class="flex" @click="active_menu = 'Language'">
                    <div class="w-1/6 flex justify-center items-center">
                        <img src="/image/site/language.svg" class="w-6 h-6" alt="language">
                    </div>
                    <div class="w-5/6 py-8 flex justify-between border-b-2 border-grey-lighter">
                        <div class="font-bold cursor-pointer">{{ $t('Language') }}</div>
                        <div v-for="lang in languages" v-if="lang.id == active_lang.id" class="capitalize">{{ lang.title }}</div>
                    </div>
                </div>
                <div class="flex">
                    <div class="w-1/6 flex justify-center items-center">
                        <img src="/image/site/notification.svg" class="w-6 h-6" alt="notification">
                    </div>
                    <div class="w-5/6 py-8 flex justify-between border-b-2 border-grey-lighter">
                      <label class="font-bold cursor-pointer" for="notification">{{ $t('Notification') }}</label>
                        <div>
                            <div class="form-switch -my-2">
                                <input type="checkbox" name="notification" id="notification" value="true" class="form-switch-checkbox" v-model="notification"> 
                                <label for="notification" class="form-switch-label"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="w-1/6 flex justify-center items-center">
                        <img src="/image/site/voice.svg" class="w-6 h-6" alt="voice">
                    </div>
                    <div class="w-5/6 py-8 flex justify-between border-b-2 border-grey-lighter">
                      <label class="font-bold cursor-pointer" for="voice">{{ $t('Tons') }}</label>
                        <div>
                            <div class="form-switch -my-2">
                                <input type="checkbox" name="voice" id="voice" class="form-switch-checkbox" v-model="voice"> 
                                <label for="voice" class="form-switch-label"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap justify-between">
                  <div class="w-full mt-8">
                      <div class="text-sm bg-white block no-underline no-underline p-3 rounded-full text-center hover:text-indigo-dark hover:bg-white w-48 bg-indigo-dark text-white border-2 border-indigo-dark mx-auto cursor-pointer font-medium" @click="showDialog">{{ $t('Logout') }}</div>
                  </div>

                  <div class="w-full mt-8" v-if="directlyIsFlutterInAppWebViewReadyDirectly === true">
                    <div class="text-sm bg-white block no-underline no-underline p-3 rounded-full text-center hover:text-indigo-dark
                    hover:bg-white w-48 bg-indigo-dark text-white border-2 border-indigo-dark mx-auto cursor-pointer font-medium"
                         @click="getHospitalList()">{{ $t('Logout Hospital') }}</div>
                  </div>
                </div>
                <!-- <div class="flex">
                    <div class="w-1/6 flex justify-center items-center">
                        <img src="/image/site/help.svg" class="w-6 h-6" alt="help">
                    </div>
                    <div class="w-5/6 py-8 flex justify-between border-b-2 border-grey-lighter">
                        <div class="font-bold cursor-pointer">{{ $t('Help') }}</div>
                        <div>{{ $t('Ask?') }}</div>
                    </div>
                </div> -->
            </div>
            <div class="w-full md:w-1/2 border-l-2 border-grey-lighter">
                <div class="border-b-2 border-grey-lighter">
                    <div class="p-6 text-center cursor-pointer capitalize font-semibold">{{ $t(active_menu) }}</div>
                </div>
                <div class="p-6 py-12 leading-normal flex flex-wrap justify-center items-center">
                    <div class="w-full md:w-3/4 -mb-2" v-if="active_menu == 'Language'">
                        <div v-for="language in languages" class="p-4 px-6 border-2 border-indigo-lightest rounded-lg w-full mb-2 flex cursor-pointer flex justify-between" 
                        :class="{ 'bg-indigo-lightest' : language.id == active_lang.id}"
                        @click="setLanguage(language)"
                        >
                            <div class="flex">
                                <img :src="language.icon" class="w-6 h-6 mr-3 rounded-full" :alt="language.title">
                                {{ language.title }}
                            </div>
                            <img src="/image/site/simple-check.svg" alt="check" v-if="language.id == active_lang.id">
                        </div>
                        <br>
                    </div>

                    <div class="w-full flex flex-wrap items-center justify-center">
                      <div class="bg-indigo-lightest rounded-lg w-full md:w-3/4" v-if="active_menu == 'Account'">
                          <div class="p-6 px-8" style="min-height: 240px;">
                              <div class="flex flex-wrap justify-between" v-if="!account_edit">
                                  <div>
                                      <div class="font-bold text-xl"><!-- {{ user.name + ' ' + user.family }} --> {{ user.title }}</div>
                                      <div>{{ user.email }}</div>
                                      <div>{{ user.username }}</div>
                                  </div>
                                  <div class="w-24" v-if="user.avatar">
                                      <img :src="user.avatar" alt="avatar">
                                  </div>
                                  <div class="font-bold mt-8 w-full">{{ $t('Here you can change your name.') }}</div>
                              </div> 
                              <div v-else class="text-grey-dark">
                                <input type="text" class="mb-2 outline-none p-4 py-3 rounded-full w-full" :placeholder="$t('name')" v-model="user.name">
                                <input type="text" class="mb-2 outline-none p-4 py-3 rounded-full w-full" :placeholder="$t('family')" v-model="user.family">
                                <input type="text" class="mb-2 outline-none p-4 py-3 rounded-full w-full" :placeholder="$t('username')" v-model="user.username">
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
                    </div>

                </div>
            </div>
        </div>
    </div>

    <modal name="confirm" :width="400" :height="230" :adaptive="true" classes="p-4 py-6 text-white">
        <div class="flex flex-col justify-between p-8 h-full bg-indigo-dark text-white rounded-lg">
          <div class="text-center leading-normal">
            {{ $t('Do you really want to unsubscribe?') }}
          </div>
          <div class="flex justify-between items-end h-full">
              <button type="button" class="dialog-btn-type-one" @click="$modal.hide('confirm')">{{ $t('Cancel') }}</button>
              <button type="button" class="dialog-btn-type-one active" @click="logout">{{ $t('Confirm') }}</button>
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
        directlyIsFlutterInAppWebViewReadyDirectly:false,
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