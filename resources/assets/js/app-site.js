/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


require('./site');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('flash', require('./components/site/utilities/Flash'));
Vue.component('vue-slide-up-down', require('./components/site/utilities/SlideUpDown'))
Vue.component('multiselect', require('./components/site/multiselect/Multiselect'))
// Vue.component('gallery', require('./components/site/Gallery'));
Vue.component('products', require('./components/site/Products'));
Vue.component('items_list', require('./components/site/ItemsList'));

Vue.component('site-form-component', require('./components/site/utilities/form/SiteForm'));
Vue.component('login-form-component', require('./components/site/utilities/form/LoginForm'));
Vue.component('custom_register_form', require('./components/site/utilities/form/CustomRegisterForm'));
Vue.component('uncomplete_fields_form', require('./components/site/utilities/form/UncompleteFieldsForm'));
// Vue.component('cart', require('./components/site/utilities/Cart'));
Vue.component('profile-edit', require('./components/site/utilities/form/ProfileEdit'));
// Vue.component('refund_form', require('./components/site/utilities/form/RefundForm'));
// Vue.component('pay_form', require('./components/site/utilities/form/PayForm'));
Vue.component('i-text', require('./components/site/utilities/form/InputText'));

Vue.component('i-textarea', require('./components/site/utilities/form/Textarea'));
Vue.component('i-checkbox', require('./components/site/utilities/form/Checkbox'));
Vue.component('i-editor-checkbox', require('./components/site/utilities/form/EditorCheckbox'));
Vue.component('i-multiselect', require('./components/site/utilities/form/Multiselect'));
Vue.component('i-date', require('./components/site/utilities/form/Date'));
Vue.component('i-time', require('./components/site/utilities/form/Time'));
Vue.component('i-uploader', require('./components/site/utilities/form/Uploader'));
Vue.component('i-editor', require('./components/site/utilities/form/Editor'));
Vue.component('i-province', require('./components/site/utilities/form/Province'));
Vue.component('i-postal-code', require('./components/site/utilities/form/PostalCodeInput'));

Vue.component('contact-us', require('./components/site/ContactUs'));
Vue.component('search-box', require('./components/site/SearchBox'));
Vue.component('public-notification', require('./components/site/PublicNotifications'));
Vue.component('news-event', require('./components/site/NewsEvent'));


import {FormCheckbox} from 'bootstrap-vue/es/components';

Vue.use(FormCheckbox);

// vee_validate -- start

import VeeValidate from './components/admin/validator/vee-validate';
import fa from './components/admin/validator/locale/fa';
import VueI18n from 'vue-i18n';

Vue.use(VueI18n);

const i18n = new VueI18n({
    locale: 'fa'
});

const config = {
    i18n,
    dictionary: {fa},
    delay: 100,
    events: '',
    // The name of the Fields (flags) object that will be injected in each of Vue's instances' data.
    fieldsBagName: 'vFields',
    errorBagName: 'vErrors'
};

Vue.use(VeeValidate, config);

// vee_validate -- end

const app = new Vue({
    el: '#app',
    data() {
        return {
            // cart: window.App.cart,
            // discount_code: '',
        }
    },
    computed: {
        // total_count() {
        //     return _.sumBy(Object.values(this.cart), 'qty')
        // },
        // total_price() {
        //     return _.sumBy(Object.values(this.cart), 'subtotal')
        // },
    },
    created() {
        // window.events.$on(
        //     'update-cart', function (items) {
        //         this.cart = items
        //     }.bind(this)
        // );
    },
    methods: {
        // addToCart(product_id) {
        //     axios['post']('/fa/cart/add', {'product_id': product_id})
        //         .then(response => {
        //             this.cart = response.data
        //             flash('با موفقیت به سبد خرید اضافه شد.')
        //         })
        // },
    },
});


require('owl.carousel');


$('.refresh-captcha-img').on('click', function () {
    var captcha = $('#captcha-img');
    var config = captcha.data('refresh-config');
    $.ajax({
        method: 'GET',
        url: '/get_captcha/' + config,
    }).done(function (response) {
        captcha.prop('src', response);
    });
});
