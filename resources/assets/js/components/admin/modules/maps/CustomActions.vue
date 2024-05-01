<template>
    <div class="flex justify-center -mx-1">

        <a class="rhc-btn rhc-action-btn rhc-btn-purple"
           :href="rowData.map_uri"
           target="_blank"
           v-html="icons.map"
           title="لینک نقشه یک"
           v-if="!rowData.isSoftDelete"></a>

        <a class="rhc-btn rhc-action-btn rhc-btn-green"
           :href="rowData.neshan_map_uri"
           target="_blank"
           v-html="icons.map"
           title="لینک نقشه نشان"
           v-if="!rowData.isSoftDelete" ></a>

        <a class="rhc-btn rhc-action-btn rhc-btn-green"
           @click="itemAction('location-sender-modal')"
           v-html="icons.send"
           title="ارسا ل پیامکی موقعیت مکانی"
           v-if="!rowData.isSoftDelete" ></a>

        <div class="mx-2  w-8">

        </div>
        <div class="rhc-btn rhc-action-btn rhc-btn-pink"
           @click="itemAction('restore')"
           v-html="icons.restore"
           v-if="rowData.isSoftDelete"
        ></div>
        <a class="rhc-btn rhc-action-btn"
           :href="rowData.index_clone_uri"
           v-html="icons.facilities"
           v-if="!rowData.isSoftDelete"
           title="نمایش لیست تغییرات"
        ></a>

        <a class="rhc-btn rhc-action-btn"
           :href="rowData.edit_uri"
           v-html="icons.edit"
           v-if="!rowData.isSoftDelete" ></a>
        <div class="rhc-btn rhc-action-btn rhc-btn-red "
           @click="itemAction('forcedelete')"
           v-html="icons.delete"
           v-if="rowData.isSoftDelete"
        ></div>

        <a class="rhc-btn rhc-action-btn"
           @click="itemAction('delete')"
           v-html="icons.delete"
        v-if="!rowData.isSoftDelete"></a>

    </div>
</template>

<script>
import CustomActionsMixin from './../../mixins/CustomActionsMixin'

export default {
    mixins: [CustomActionsMixin]
}
</script>
