<template>
    <div @click="onClick" class="flex flex-row">
        <div class="flex flex-col  rounded border border-blue  px-1 mx-1">
            <div>
                <label class="font-bold">کداشتراک: </label>
                <span>{{ rowData.user.subscrip_code }}</span>
            </div>
            <div>
                <label class="font-bold">نام: </label>
                <span>{{ rowData.user.fullname }}</span>
            </div>
            <div>
                <label class="font-bold">موبایل: </label>
                <span>{{ rowData.user.mobile }}</span>
            </div>
            <div>
                <label class="font-bold">موبایل دوم: </label>
                <span>{{ rowData.user.second_mobile }}</span>
            </div>

            <div>
                <label class="font-bold">کل سفرهای تایید شده: </label>
                <span>{{ rowData.user.total_verified_travel }}</span>
            </div>
            <div>
                <label class="font-bold">شارژ:</label>
                <span>{{ rowData.user.wallet }}</span>
            </div>
        </div>
        <div class="flex flex-col  rounded border border-blue  px-1 mx-1">
            <div>
                <label class="font-bold">کدپیگیری: </label>
                <span>{{ rowData.tracking_code }}</span>
            </div>
            <div>
                <label class="font-bold">مبدا: </label>
                <span>{{ rowData.beginning }}</span>
            </div>
            <div>
                <label class="font-bold">ساعت رفت: </label>
                <span>{{ rowData.beginning_time }}</span>
            </div>
            <div>
                <label class="font-bold">مقصد: </label>
                <span>{{ rowData.destination }}</span>
            </div>
            <div>
                <label class="font-bold">ساعت برگشت: </label>
                <span>{{ rowData.time_return }}</span>
            </div>
            <div>
                <label class="font-bold">همراه: </label>
                <span>{{ rowData.accompanying_person }}</span>
            </div>
            <div>
                <label class="font-bold">علت: </label>
                <span>{{ rowData.reason }}</span>
            </div>
            <div>
                <label class="font-bold">وضعیت: </label>
                <span>{{ rowData.status_fa }}</span>
            </div>

        </div>

        <div
            class="flex flex-col  rounded border border-blue  px-1 mx-1"
            v-if="rowData.status === 'verify'">


            <div >
                <label class="font-bold"> نام راننده: </label>
                <span>{{ rowData.driver.name }}</span>
            </div>
            <div >
                <label class="font-bold"> شماره راننده: </label>
                <span>{{ rowData.driver.mobile }}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        rowData: {
            type: Object,
            required: true
        },
        rowIndex: {
            type: Number
        }
    },
    methods: {
        onClick(event) {
            console.log('my-detail-row: on-click', event.target)
        },
    },
}
</script>
