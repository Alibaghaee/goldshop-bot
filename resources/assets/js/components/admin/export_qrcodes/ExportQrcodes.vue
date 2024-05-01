<template>
    <div>
        <div class="mb-6">
            <label class="typo__label">Select Type</label>
            <multiselect v-model="type" :options="typesOptions" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Pick one" label="name" track-by="name" :preselect-first="true" @input="onChangeType" >
            </multiselect>
        </div>
        <div class="mb-6">
            <label class="typo__label">Select Departments (No Choose = All)</label>
            <multiselect v-model="value" :options="options" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name" track-by="name" :preselect-first="false" @input="onChange" >
                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} options selected</span></template>
            </multiselect>
        </div>
        <div class="mb-6" v-if="rooms.length">
            <label class="typo__label">Select Rooms (No Choose = All)</label>
            <multiselect v-model="selectedRooms" :options="rooms" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name" track-by="name" :preselect-first="false" @input="onChangeRooms" >
                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} options selected</span></template>
            </multiselect>
        </div>
        <div class="mb-6" v-if="beds.length">
            <label class="typo__label">Select Beds (No Choose = All)</label>
            <multiselect v-model="selectedBeds" :options="beds" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name" track-by="name" :preselect-first="false" @input="onChangeBeds" >
                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} options selected</span></template>
            </multiselect>
        </div>

        <div class="mb-6">
            <a :href="exportPath" target="_blank" class="ml-auto rhc-btn rhc-btn-indigo mr-2 flex items-center" type="button">
                <span>Export QR Codes</span>
                <svg class="w-6 fill-current ml-2 align-middle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 480 320"><path d="M387.002 121.001C372.998 52.002 312.998 0 240 0c-57.998 0-107.998 32.998-132.998 81.001C47.002 87.002 0 137.998 0 200c0 65.996 53.999 120 120 120h260c55 0 100-45 100-100 0-52.998-40.996-96.001-92.998-98.999zM208 172V96h64v76h68L240 272 140 172h68z"/></svg>
            </a>
        </div>
    </div>
</template>

<script>

import Multiselect from 'vue-multiselect'

export default {
    name: "ExportQrcodes",
    components: {
        Multiselect
    },
    props : [ 'departments', 'types' ],
    data () {
        return {
            basePath : '/qrcodes/qr_codes/export',
            exportPath : '/qrcodes/qr_codes/export',
            valueOfDepartments: [],
            departmentsOptions: this.departments,
            typesOptions: this.types,
            type: null,
            value: [],
            options: this.departments,
            rooms: [],
            selectedRooms : [],
            beds: [],
            selectedBeds : [],
            exportDps: '',
            exportRooms: '',
            exportBeds: '',
            exportType: '',
        }
    },
    methods: {
        onChangeType (value) {
            var type = '';
            type = this.type.id;
            this.exportType = type;
            this.exportPath = this.basePath + '?type=' + this.exportType+ '&dp=' + this.exportDps + '&rooms=' + this.exportRooms + '&beds=' + this.exportBeds;

        },
        onChange (value) {
            var dp = '';
            this.value.forEach(function (arrayItem) {
                var x = arrayItem.id;
                dp = dp + x + '|';
            });
            this.exportDps = dp;
            this.exportPath = this.basePath + '?type=' + this.exportType+ '&dp=' + this.exportDps + '&rooms=' + this.exportRooms + '&beds=' + this.exportBeds;

            axios.post("/qrcodes/qr_codes/get_rooms", JSON.stringify(this.value) )
                .then(response => this.rooms = response.data);
        },
        onChangeRooms (selectedRooms) {
            var rooms = '';
            this.selectedRooms.forEach(function (arrayItem) {
                var x = arrayItem.id;
                rooms = rooms + x + '|';
            });
            this.exportRooms = rooms;
            this.exportPath = this.basePath + '?type=' + this.exportType+ '&dp=' + this.exportDps + '&rooms=' + this.exportRooms + '&beds=' + this.exportBeds;

            axios.post("/qrcodes/qr_codes/get_beds", JSON.stringify(this.selectedRooms) )
                .then(response => this.beds = response.data);
        },
        onChangeBeds (selectedBeds) {
            var beds = '';
            this.selectedBeds.forEach(function (arrayItem) {
                var x = arrayItem.id;
                beds = beds + x + '|';
            });
            this.exportBeds = beds;
            this.exportPath = this.basePath + '?type=' + this.exportType+ '&dp=' + this.exportDps + '&rooms=' + this.exportRooms + '&beds=' + this.exportBeds;
        },
    }
}
</script>

<style scoped>

</style>
