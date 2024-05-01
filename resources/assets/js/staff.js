/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

let languages = {}
// axios.get('/locale/get/' + window.App.locale)
//     .then(function (response){ 
//         languages[window.App.locale] = response.data
//     })

$.ajax({
    url: '/locale/get/' + window.App.locale,
    async: false,
    success: function (data) {
        languages[window.App.locale] = data
    }
});

window.genrateAddress = function genrateAddress(address, language = window.App.locale) {
    return '/' + language.toLowerCase() + '/' + address + '?t=' + Date.now();
}

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('flash', require('./components/admin/utilities/Flash').default);
Vue.component('vue-slide-up-down', require('./components/admin/utilities/SlideUpDown').default)
Vue.component('requests', require('./components/staff/Requests').default)
Vue.component('rooms', require('./components/staff/Rooms').default)
Vue.component('settings', require('./components/staff/Settings').default)
Vue.component('settings-mobile', require('./components/staff/SettingsMobile').default)
Vue.component('staff-login', require('./components/staff/Login').default)
Vue.component('faq', require('./components/staff/Faq').default)
Vue.component('user-login', require('./components/user/Login').default)
Vue.component('services', require('./components/user/Services').default)
Vue.component('your-requests', require('./components/user/YourRequests').default)
Vue.component('user-settings', require('./components/user/Settings').default)
Vue.component('user-settings-mobile', require('./components/user/SettingsMobile').default)
Vue.component('user-notification', require('./components/user/Notification').default)
Vue.component('web-push', require('./components/staff/WebPush').default)
Vue.component('hospital-list', require('./components/Shared/HospitalList').default)
Vue.component('get-hospital', require('./components/Shared/GetHospital').default)


// vee_validate -- start

import VeeValidate from './components/admin/validator/vee-validate';
import de from './components/admin/validator/locale/de';
import fr from './components/admin/validator/locale/fr';
import es from './components/admin/validator/locale/es';
import en from './components/admin/validator/locale/en';
// import messages from './components/admin/validator/messages';
import VueI18n from 'vue-i18n';

Vue.use(VueI18n);

const messages = Object.assign(languages)

// Create VueI18n instance with options
const i18n = new VueI18n({
    locale: window.App.locale, // set locale
    fallbackLocale: 'en',
    messages, // set locale messages
    silentTranslationWarn: true,
})

const config = {
    i18n,
    dictionary: {de, fr, es, en},
    delay: 100,
    events: 'change|blur',
    // The name of the Fields (flags) object that will be injected in each of Vue's instances' data.
    fieldsBagName: 'vFields',
    errorBagName: 'vErrors'
};

Vue.use(VeeValidate, config);

// vee_validate -- end

import ClickOutside from 'vue-click-outside'

const app = new Vue({
    el: '#app',
    data: {
        mobile_menu_open: false,
    },

    i18n,

    methods: {
        toggleMobileMenu() {
            this.mobile_menu_open = !this.mobile_menu_open
            this.$cookie.set('mobile_menu_open', this.mobile_menu_open, 7);
        },
        setData() {
            this.mobile_menu_open = this.$cookie.get('mobile_menu_open') == 'false' ? false : true;
        },
        showLogoutDialog(data) {
            // this.$modal.show('logout_modal')
            // change it to logout
            axios.post('/logout')
                .then(function (response) {
                    window.location.href = response.data.redirect;
                })
                .catch(function (error) {
                    flash('Error', 'error')
                });
        },
        logout() {
            this.$modal.hide('logout_modal')
            axios.post('/logout')
                .then(function (response) {
                    window.location.href = response.data.redirect;
                })
                .catch(function (error) {
                    flash('Error', 'error')
                });
        },
    },

    directives: {
        ClickOutside
    }
});

require('owl.carousel');

// Pusher.logToConsole = true;


// fix mobile login form issue
$('#username, #code').on('focus', function () {
    window.scrollTo(0, $('#username, #code').offset().top - 20)
})
$('#password').on('focus', function () {
    window.scrollTo(0, $('#password').offset().top - 10)
})