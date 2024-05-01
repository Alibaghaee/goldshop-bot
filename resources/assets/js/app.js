/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('side-nav', require('./components/admin/sidenav/SideNav.vue'));
Vue.component('simple-card', require('./components/admin/utilities/SimpleCard'));
Vue.component('flash', require('./components/admin/utilities/Flash'));
Vue.component('vue-slide-up-down', require('./components/admin/utilities/SlideUpDown'))
Vue.component('todos', require('./components/admin/todos/Todos'));
Vue.component('filter-form-control', require('./components/admin/utilities/FormControl'));
Vue.component('multiselect', require('./components/admin/multiselect/Multiselect'))
Vue.component('i-tag-multiselect', require('./components/admin/utilities/form/TagMultiselect'));
Vue.component('date-picker', require('./components/admin/datapicker/VuePersianDatetimePicker'));
Vue.component('lottery', require('./components/admin/utilities/Lottery'))
Vue.component('lottery-one', require('./components/admin/utilities/Lottery-one'))
Vue.component('lottery-3', require('./components/admin/utilities/Lottery-3'))

Vue.component('global-actions', require('./components/admin/vuetable_partials/GlobalActions'))
Vue.component('admins-table', require('./components/admin/modules/admins/AdminsTable.vue'));
Vue.component('users-table', require('./components/admin/modules/users/UsersTable.vue'));
Vue.component('levels-table', require('./components/admin/modules/levels/LevelsTable.vue'));
Vue.component('settings-table', require('./components/admin/modules/settings/SettingsTable.vue'));
Vue.component('categories-table', require('./components/admin/modules/categories/CategoriesTable.vue'));
Vue.component('categoryitems-table', require('./components/admin/modules/categoryitems/CategoryItemsTable.vue'));
// Vue.component('departments-table', require('./components/admin/modules/departments/DepartmentsTable.vue'));
// Vue.component('experts-table', require('./components/admin/modules/experts/ExpertsTable.vue'));
// Vue.component('rooms-table', require('./components/admin/modules/rooms/RoomsTable.vue'));
// Vue.component('expert-attendance-days-table', require('./components/admin/modules/expert_attendance_days/ExpertAttendanceDaysTable.vue'));
Vue.component('menus-table', require('./components/admin/modules/menus/MenusTable.vue'));
Vue.component('menu-items-table', require('./components/admin/modules/menu_items/MenuItemsTable.vue'));
Vue.component('contents-table', require('./components/admin/modules/contents/ContentsTable.vue'));
// Vue.component('galleries-table', require('./components/admin/modules/galleries/GalleriesTable.vue'));
// Vue.component('gallery-items-table', require('./components/admin/modules/gallery_items/GalleryItemsTable.vue'));
// Vue.component('orders-table', require('./components/admin/modules/orders/OrdersTable.vue'));
// Vue.component('tasks-table', require('./components/admin/modules/tasks/TasksTable.vue'));
// Vue.component('tasks-report', require('./components/admin/modules/tasks/Report.vue'));
// Vue.component('refers-table', require('./components/admin/modules/refers/RefersTable.vue'));
// Vue.component('customers-table', require('./components/admin/modules/customers/CustomersTable.vue'));
// Vue.component('purchase-invoices-table', require('./components/admin/modules/purchase_invoices/PurchaseInvoicesTable.vue'));
// Vue.component('contracts-table', require('./components/admin/modules/contracts/ContractsTable.vue'));
// Vue.component('tickets-table', require('./components/admin/modules/tickets/TicketsTable.vue'));
// Vue.component('answers-table', require('./components/admin/modules/answers/AnswersTable.vue'));
// Vue.component('attendances-table', require('./components/admin/modules/attendances/AttendancesTable.vue'));
// Vue.component('received-letters-table', require('./components/admin/modules/received_letters/ReceivedLettersTable.vue'));
// Vue.component('sended-letters-table', require('./components/admin/modules/sended_letters/SendedLettersTable.vue'));
// Vue.component('blacklists-table', require('./components/admin/modules/blacklists/BlacklistsTable.vue'));
// Vue.component('blacklist-send-logs-table', require('./components/admin/modules/blacklist_send_logs/BlacklistSendLogsTable.vue'));
Vue.component('payments-table', require('./components/admin/modules/payments/PaymentsTable.vue'));
Vue.component('refunds-table', require('./components/admin/modules/refunds/RefundsTable.vue'));
Vue.component('pays-table', require('./components/admin/modules/pays/PaysTable.vue'));
Vue.component('products-table', require('./components/admin/modules/products/ProductsTable.vue'));
Vue.component('tags-table', require('./components/admin/modules/tags/TagsTable.vue'));
Vue.component('product-items-table', require('./components/admin/modules/product_items/ProductItemsTable.vue'));
Vue.component('purchases-table', require('./components/admin/modules/purchases/PurchasesTable.vue'));
Vue.component('contacts-table', require('./components/admin/modules/contacts/ContactsTable.vue'));
Vue.component('discounts-table', require('./components/admin/modules/discounts/DiscountsTable.vue'));
Vue.component('discount-items-table', require('./components/admin/modules/discount_items/DiscountItemsTable.vue'));
Vue.component('packages-table', require('./components/admin/modules/packages/PackagesTable.vue'));
Vue.component('forms-table', require('./components/admin/modules/forms/FormsTable.vue'));
Vue.component('fields-table', require('./components/admin/modules/fields/FieldsTable.vue'));
Vue.component('notifies-table', require('./components/admin/modules/notifies/NotifiesTable.vue'));
Vue.component('prizes-table', require('./components/admin/modules/prizes/PrizesTable.vue'));
Vue.component('members-table', require('./components/admin/modules/members/MembersTable.vue'));
Vue.component('sms-sends-table', require('./components/admin/modules/sms_sends/SmsSendsTable.vue'));
Vue.component('sms-receives-table', require('./components/admin/modules/sms_receives/SmsReceivesTable.vue'));
Vue.component('tabiat-product-categories-table', require('./components/admin/modules/tabiat_product_categories/TabiatProductCategoriesTable.vue'));
Vue.component('tabiat-products-table', require('./components/admin/modules/tabiat_products/TabiatProductsTable.vue'));
Vue.component('tabiat-codes-table', require('./components/admin/modules/tabiat_codes/TabiatCodesTable.vue'));
Vue.component('reports-table', require('./components/admin/modules/reports/ReportsTable.vue'));
Vue.component('lottery-ones-table', require('./components/admin/modules/lottery_ones/LotteryOnesTable.vue'));
Vue.component('selected-customers-table', require('./components/admin/modules/selected_customers/SelectedCustomersTable.vue'));
Vue.component('maps-table', require('./components/admin/modules/maps/MapsTable.vue'));
Vue.component('admin-profiles-table', require('./components/admin/modules/admin_profiles/AdminProfilesTable.vue'));
Vue.component('network-activitys-table', require('./components/admin/modules/network_activity/NetworkActivityTable.vue'));
Vue.component('map-clones-table', require('./components/admin/modules/map_clones/MapClonesTable.vue'));
Vue.component('travels-table', require('./components/admin/modules/travel/TravelTable.vue'));
Vue.component('drivers-table', require('./components/admin/modules/drivers/DriversTable.vue'));
Vue.component('news-letters-table', require('./components/admin/modules/news_letters/NewsLettersTable.vue'));
Vue.component('news-letter-users-table', require('./components/admin/modules/news_letters/user/NewsLetterUsersTable.vue'));
Vue.component('news-letter-drivers-table', require('./components/admin/modules/news_letters/driver/NewsLetterDriversTable.vue'));
Vue.component('news-letter-users-send-form', require('./components/admin/modules/news_letters/user/SendForm.vue'));
Vue.component('news-letter-drivers-send-form', require('./components/admin/modules/news_letters/driver/SendForm.vue'));
Vue.component('sms-templates-table', require('./components/admin/modules/sms_templates/SmsTemplatesTable.vue'));
Vue.component('driver-travels-table', require('./components/admin/modules/driver-travels/DriverTravelsTable.vue'));
Vue.component('contact-numbers-table', require('./components/admin/modules/contact_numbers/ContactNumbersTable.vue'));
Vue.component('contact-categories-table', require('./components/admin/modules/contact_categories/ContactCategoriesTable.vue'));
Vue.component('single-sms-senders-table', require('./components/admin/modules/single_sms_senders/SingleSmsSendersTable.vue'));
Vue.component('sender-numbers-table', require('./components/admin/modules/sender_numbers/SenderNumbersTable.vue'));
Vue.component('panel-sms-table', require('./components/admin/modules/panel_sms/PanelSmsTable.vue'));

Vue.component('single-send-sms-contact-numbers-table', require('./components/admin/modules/single_sms_senders/contactNumber/SingleSmsSendersContactNumbersTable.vue'));
Vue.component('single-send-sms-contact-numbers-send-form', require('./components/admin/modules/single_sms_senders/contactNumber/SendForm.vue'));


Vue.component('group-sms-senders-table', require('./components/admin/modules/group_sms_senders/GroupSmsSendersTable.vue'));

Vue.component('group-send-sms-contact-category-table', require('./components/admin/modules/group_sms_senders/contactCategory/GroupSmsSendersContactCategoriesTable.vue'));
Vue.component('group-send-sms-contact-category-send-form', require('./components/admin/modules/group_sms_senders/contactCategory/SendForm.vue'));
Vue.component('comments-table', require('./components/admin/modules/comments/CommentsTable.vue'));

Vue.component('invoice-portal-table', require('./components/admin/modules/invoice_portals/InvoicePortalsTable.vue'));
Vue.component('invoice-portal-table', require('./components/admin/modules/invoice_portals/InvoicePortalsTable.vue'));
Vue.component('invoice-body-portal-table', require('./components/admin/modules/invoice_body_portals/InvoiceBodyPortalsTable.vue'));
// {{dont_delete_this_comment}}

Vue.component('group-checkbox', require('./components/admin/utilities/GroupCheckbox'));
Vue.component('delete-modal', require('./components/admin/modals/DeleteModal'));
Vue.component('finish-refer-modal', require('./components/admin/modals/FinishReferModal'));
Vue.component('blacklist-send-modal', require('./components/admin/modals/BlacklistSendModal'));
Vue.component('location-sender-modal', require('./components/admin/modals/LocationSenderModal'));
Vue.component('verify-travel-modal', require('./components/admin/modals/VerifyTravelModal'));
Vue.component('restore-modal', require('./components/admin/modals/RestoreModal'));
Vue.component('force-delete-modal', require('./components/admin/modals/ForceDeleteModal'));
Vue.component('blacklist-price-update-modal', require('./components/admin/modals/BlacklistPriceUpdateModal'));
Vue.component('editor', require('@tinymce/tinymce-vue').default);


// form components for create pages
Vue.component('form-component', require('./components/admin/utilities/form/Form'));
Vue.component('login-form-component', require('./components/admin/utilities/form/LoginForm'));
Vue.component('i-text', require('./components/admin/utilities/form/InputText'));
Vue.component('i-input-map', require('./components/admin/utilities/form/InputMap'));
Vue.component('i-promotional', require('./components/admin/utilities/form/InputPromotional'));
Vue.component('i-textarea', require('./components/admin/utilities/form/Textarea'));
Vue.component('i-checkbox', require('./components/admin/utilities/form/Checkbox'));
Vue.component('i-editor-checkbox', require('./components/admin/utilities/form/EditorCheckbox'));
Vue.component('i-multiselect', require('./components/admin/utilities/form/Multiselect'));
Vue.component('i-date', require('./components/admin/utilities/form/Date'));
Vue.component('i-time', require('./components/admin/utilities/form/Time'));
Vue.component('i-uploader', require('./components/admin/utilities/form/Uploader'));
Vue.component('i-editor', require('./components/admin/utilities/form/Editor'));
Vue.component('i-province', require('./components/admin/utilities/form/Province'));

// form components for filter in index pages
Vue.component('filter-form-component', require('./components/admin/utilities/filter-form/FilterForm'));
Vue.component('i-text-filter', require('./components/admin/utilities/filter-form/FilterInputText'));
Vue.component('i-multiselect-filter', require('./components/admin/utilities/filter-form/FilterMultiselect'));
Vue.component('i-checkbox-filter', require('./components/admin/utilities/filter-form/FilterCheckbox'));
Vue.component('i-date-filter', require('./components/admin/utilities/filter-form/FilterDate'));

Vue.component('sortable-items', require('./components/admin/utilities/SortableItems'));
Vue.component('sortable-tree-list', require('./components/admin/utilities/SortableTreeList'));
// Vue.component('call', require('./components/admin/CallLog'));

import GlobalActions from './components/admin/vuetable_partials/GlobalActions';
// This imports <b-modal> as well as the v-b-modal directive as a plugin:
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
    // events: 'input|blur',
    // The name of the Fields (flags) object that will be injected in each of Vue's instances' data.
    fieldsBagName: 'vFields',
    errorBagName: 'vErrors'
};

Vue.use(VeeValidate, config);

// vee_validate -- end

const app = new Vue({
    el: '#app',
    data: {
        right_open: false,
        left_open: null,
    },

    created() {
        window.events.$on(
            'minimized', side => this.minimize(side)
        );
        this.setData();
    },

    methods: {
        minimize(side) {
            if (side == 'right') {
                this.toggleRight()
            } else if (side == 'left') {
                this.toggleLeft()
            }
        },
        toggleRight() {
            this.right_open = !this.right_open
            this.$cookie.set('right_open', this.right_open, 7);
        },
        toggleLeft() {
            this.left_open = !this.left_open
            this.$cookie.set('left_open', this.left_open, 7);
        },
        setData() {
            this.right_open = this.$cookie.get('right_open') == 'true' ? true : false;
            this.left_open = this.$cookie.get('left_open') == 'true' ? false : false;
        }
    },

    computed: {
        middleSectionWidthClass() {
            if (this.right_open && this.left_open) {
                return 'md:w-3/5 lg:w-3/5';
            } else if (this.right_open || this.left_open) {
                return 'md:w-4/5 lg:w-4/5';
            } else {
                return '';
            }
        }
    }
});

require('owl.carousel');

