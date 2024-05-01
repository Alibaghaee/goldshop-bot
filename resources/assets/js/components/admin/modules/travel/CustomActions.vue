<template>
    <div class="flex justify-center">
        <a class="rhc-btn rhc-action-btn rhc-btn-green"
           @click="itemAction('verify-travel-modal')"
           v-html="icons.facilities"
           title="تایید"
           v-if="rowData.status ==='pending'"
        ></a>
    </div>
</template>

<script>
import CustomActionsMixin from './../../mixins/CustomActionsMixin'

export default {
    mixins: [CustomActionsMixin]
}
</script>
