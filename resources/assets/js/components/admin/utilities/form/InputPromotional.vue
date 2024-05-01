<template>
    <div class="md:flex md:items-center" v-show="type != 'hidden'">
        <div class="md:w-1/4">
            <label class="block text-grey-dark md:text-right mb-1 md:mb-0 pr-4" :for="name_">
                {{ title }} :
            </label>
            <div v-if="form.errors.has(name_)" class="invisible">.</div>
        </div>
        <div class="w-full">
            <input
                class="rhc-form-control"
                autocomplete=off
                :type="type"
                v-validate="validate"
                :name="name_"
                :id="name_"
                :placeholder="title"
                v-model="form_data[name_]"
                :disabled="is_disabled"
            >
            <span class="text-pink">{{ vErrors.first(name_) }}</span>
            <div class="text-pink" v-if="form.errors.has(name_)" v-text="form.errors.get(name_)"></div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['form', 'form_data', 'name_', 'title', 'type', 'validate', 'value', 'is_disabled', 'promotional_available_item_values','editable'],
    created() {
        if (this.promotional_available_item_values != null && this.editable ) {

           let id = this.name_.split(".")[1];

            function filterIt(arr, searchKey,arrayKey) {
                return arr.filter(obj => Object.keys(obj).some(key => obj[arrayKey].includes(searchKey)));
            }



            this.value=filterIt(this.promotional_available_item_values ,id,'id')[0].value;
        }
        this.$set(this.form_data, this.name_, this.value)
    }
}
</script>
