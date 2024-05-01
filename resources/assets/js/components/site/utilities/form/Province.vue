<template>
    <div>
      <div class="md:flex md:items-center mb-4">
          <!-- <div class="md:w-1/4">
            <label class="block text-grey-dark md:text-right mb-1 md:mb-0 pr-4" for="province">
              استان :
            </label>
            <div v-if="form.errors.has('province.id')" class="invisible">.</div>
          </div> -->
          <div class="w-full">

            <multiselect 
            v-model="province" 
            :close-on-select="true" 
            track-by="name" 
            label="name"
            :options="provinces" 
            :searchable="true" 
            dir="rtl"
            id="province"
            @select=""
            :disabled="is_disabled"
            :group-label="group_label"
            :group-values="group_values"
            @input="onSelect"
            placeholder="استان محل سکونت *"
            >
            </multiselect>
            
            <div class="text-pink" v-if="form.errors.has('province_id.id')" v-text="form.errors.get('province_id.id')"></div>
          </div>
      </div>

      <transition name="fade">
      <div class="md:flex md:items-center mb-4" v-if="cities.length">
          <!-- <div class="md:w-1/4">
            <label class="block text-grey-dark md:text-right mb-1 md:mb-0 pr-4" for="city">
              شهر :
            </label>
            <div v-if="form.errors.has('city.id')" class="invisible">.</div>
          </div> -->
          <div class="w-full">

            <multiselect 
            v-model="city" 
            :close-on-select="true" 
            track-by="name" 
            label="name"
            :options="cities" 
            :searchable="true" 
            dir="rtl"
            id="city"
            @select=""
            :disabled="is_disabled"
            :group-label="group_label"
            :group-values="group_values"
            placeholder="شهر محل سکونت *"
            >
            </multiselect>
            
            <div class="text-pink" v-if="form.errors.has('city_id.id')" v-text="form.errors.get('city_id.id')"></div>
          </div>
      </div>
      </transition>

    </div>
</template>

<script>
    export default {
        props: ['form', 'form_data', 'options', 'province_value', 'city_value', 'is_disabled', 'group_values', 'group_label'],
        data () {
          return {
            province: this.province_value,
            city: this.city_value,
            provinces: [],
            cities: []
          }
        },
        created () {
            this.form_data['province_id'] = this.province_value;
            this.form_data['city_id'] = this.city_value;
            this.getProvinces();
            if (typeof(this.province_value) != 'undefined') {
              this.setCities(this.province_value.id);
            }
        },
        watch : {
          province (val){
            this.form_data['province_id'] = val;
          },
          city (val){
            this.form_data['city_id'] = val;
          }
        },

        methods : {
          getProvinces(){
            axios.get('/api/provinces')
                .then(response => {
                  this.provinces = response.data
                })
                .catch(error => {
                  //
                });
          },

          onSelect(){
            this.city = ''
            this.setCities(this.province.id)
          },

          setCities(province_id){
            axios.get('/api/provinces/' + province_id + '/cities')
                .then(response => {
                  this.cities = response.data
                })
                .catch(error => {
                  //
                });
          }
        }
    }
</script>