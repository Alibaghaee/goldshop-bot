<template>
    <div @click="onClick" class="flex flex-col">
        <div>
            <label class="font-bold">نام کاربری: </label>
            <span>{{ rowData.username }}</span>
        </div>
        <div>
            <label class="font-bold">وضعیت: </label>
            <span>{{ rowData.statusFa }}</span>
        </div>
        <div class="rounded p-2 ">
            <label class="font-bold">شماره های ارسال کننده: </label>
            <div class="flex flex-col" v-for="senderNumber of rowData.senderNumbers">
                <div class="flex flex-row border border-blue rounded p-2 m-2 ">
                    <div class="px-2 mx-2">
                        <label class="font-bold">شماره: </label>
                        <span>{{ senderNumber.number }}</span>
                    </div>

                    <div class="px-2 mx-2">
                        <label class="font-bold">نوع: </label>
                        <span>{{ senderNumber.typeFa }}</span>
                    </div>
                    <div class="px-2 mx-2">
                        <label class="font-bold">وضعیت: </label>
                        <span>{{ senderNumber.statusFa }}</span>
                    </div>
                </div>
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
