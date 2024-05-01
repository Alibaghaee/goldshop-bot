import './bootstrap';
import { createApp } from 'vue';
import CreateInvoice from './user/components/invoice/CreateInvoice.vue';
import Vue3PersianDatetimePicker from 'vue3-persian-datetime-picker'
const app = createApp({})


app.component('CreateInvoice', CreateInvoice)
app.component('DatePicker', Vue3PersianDatetimePicker)




app.use(Vue3PersianDatetimePicker, {
    name: 'CustomDatePicker',
    props: {
        format: 'YYYY-MM-DD HH:mm',
        displayFormat: 'jYYYY-jMM-jDD',
        editable: false,
        inputClass: '',
        altFormat: 'YYYY-MM-DD HH:mm',
        color: 'rgb(51 65 85 / var(--tw-bg-opacity))',
        autoSubmit: false,

    }
})


app.mount('#app')
