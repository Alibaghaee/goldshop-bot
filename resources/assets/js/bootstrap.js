
window._ = require('lodash');
window.Popper = require('popper.js').default;

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    // console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });

window.Vue = require('vue');

window.events = new Vue();

window.minimize = function (side) {
    window.events.$emit('minimized', { side });
};

window.flash = function (message, level = 'success') {
    window.events.$emit('flash', { message, level });
};

window.locationPicker = function ( lat_long ) {
    window.events.$emit('onChangeLocationPicker', {  lat_long });
};


window.deleteModal = function (data) {
    window.events.$emit('deleteModal', { data });
};
window.restoreModal = function (data) {
    window.events.$emit('restoreModal', { data });
};
window.forcedeleteModal = function (data) {
    window.events.$emit('forcedeleteModal', { data });
};

window.finishReferModal = function (data) {
    window.events.$emit('finishReferModal', { data });
};

window.blacklistSendModal = function (data) {
    window.events.$emit('blacklistSendModal', { data });
};

window.blacklistPriceUpdateModal = function (data) {
    window.events.$emit('blacklistPriceUpdateModal', { data });
};
window.locationSenderModal = function (data) {
    window.events.$emit('locationSenderModal', { data });
};

window.verifyTravelModal = function (data) {
    window.events.$emit('verifyTravelModal', { data });
};

window.VueCookie = require('vue-cookie');
window.Vue.use(window.VueCookie);

import VModal from 'vue-js-modal';
Vue.use(VModal);

import VueLazyLoad from 'vue-lazyload'
Vue.use(VueLazyLoad)
