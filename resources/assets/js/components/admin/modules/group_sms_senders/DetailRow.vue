<template>
    <div @click="onClick" class="flex flex-col">
        <div>
            <label class="font-bold">متن: </label>
            <span>{{ rowData.description }}</span>
        </div>
        <div>
            <label class="font-bold">گروه: </label>
            <span>{{ rowData.contactCategory.title }}</span>
        </div>
        <div>
            <label class="font-bold">تعداد مخاطبان: </label>
            <span>{{ rowData.contactCategory.contactsCount }}</span>
        </div>


        <div>
            <label class="font-bold">وضعیت: </label>
            <span>{{ rowData.statusFa }}</span>
        </div>

        <div>
            <label class="font-bold">نوع: </label>
            <span>{{ rowData.typeFa }}</span>
        </div>


        <div>
            <label class="font-bold">ارسال کننده: </label>
            <span>{{ rowData.senderNumber.number }}</span>
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
