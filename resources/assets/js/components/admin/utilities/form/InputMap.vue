<template>
    <div class="grid grid-cols-1  md:items-center mb-6" v-show="type != 'hidden'">
        <div class="md:w-1/4">
            <label class="block text-grey-dark md:text-right mb-1 md:mb-0 pr-4" :for="name">
                {{ title }} :
            </label>
            <div v-if="form.errors.has(name)" class="invisible">.</div>
        </div>
        <input type="hidden" id="input_map_geo" class=" input_map_leaflet" v-model="form_data[name]">
        <div class="md:w-2/3">
            <input
                class=" rhc-form-control "
                autocomplete=off
                :type="type"
                v-validate="validate"
                :name="name"
                :id="name"
                :placeholder="title"
                v-model="form_data[name]"
                :disabled="is_disabled"

                readonly
            >
            <span class="text-pink">{{ vErrors.first(name) }}</span>
            <div class="text-pink" v-if="form.errors.has(name)" v-text="form.errors.get(name)"></div>
        </div>
        <div id="geoContainer" class="mapContainer w-full h-full    py-2   m-auto"></div>
        <div class="text-center my-2">
            <div class="p-2 rounded border text-blue  border-blue hover:text-white hover:bg-blue  "
                 onclick="getGeoLocationForLeaflet()" v-if="!is_clone">
                تنظیم موقعیت مکانی من از روی GPS
            </div>
        </div>
    </div>
</template>


<script>
export default {
    props: ['form', 'form_data', 'name', 'title', 'type', 'validate', 'value', 'is_disabled','is_clone'],
    created() {
        // this.form_data[this.name] = this.value
        if (!this.is_clone){

            window.events.$on('onChangeLocationPicker', data => this.changeLocation(data));
        }
        this.$set(this.form_data, this.name, this.value)
    },
    methods: {
        changeLocation(data) {


            this.$set(this.form_data, this.name, data.lat_long)
        }
    }

}


</script>

