<template>
    <div>
        <div class="mb-6">
            <label class="typo__label">Select Hospital Copy From</label>
            <multiselect v-model="form_data['hospitalCopyFrom']" :options="hospitals" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true"  label="name" track-by="name" :preselect-first="false" @input="onChangeHospital" >
                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} options selected</span></template>
            </multiselect>
        </div>
        <div class="mb-6" v-if="departments.length">
            <label class="typo__label">Select Departments</label>
            <multiselect  v-model="form_data['selectedDepartments']" :options="departments" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name" track-by="name" :preselect-first="false"  >
                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} options selected</span></template>
            </multiselect>
        </div>
        <div class="mb-6">
            <label class="typo__label">Select Hospital Copy To</label>
            <multiselect  v-model="form_data['hospitalCopyTo']" :options="hospitals" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true"  label="name" track-by="name" :preselect-first="false"  >
                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} options selected</span></template>
            </multiselect>
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
    props : {
        form: Object,
        form_data: Object,
        hospitals: Array,
        },
    data () {
        return {
            departments: [],


        }
    },
    created () {
        this.$set(this.form_data)
    },
    methods: {
        onChangeHospital () {
            console.log(this.form_data['hospitalCopyFrom'])
            axios.post("/qrcodes/qr_codes/get_departments", JSON.stringify(this.form_data['hospitalCopyFrom']) )
                .then(response => this.departments = response.data);
        },

    }
}
</script>

