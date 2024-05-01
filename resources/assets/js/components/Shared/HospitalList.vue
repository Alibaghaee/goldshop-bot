<template>
  <div>
    <div>
    </div>

    <div class="container">
      <div class="bg-white rounded-lg flex flex-wrap mt-4 md:mt-6">
        <div class="w-full md:w-1/2 p-6 md:px-12">
          <div class="flex flex-col">
            <div v-for="hospital in hospitals" class="  py-4 px-2 flex flex-row hover:shadow-lg">
              <!--              <div>{{hospital.title}}</div>-->
              <div class="  px-2"><span>Code:</span>{{ hospital.access_code }}</div>
              <div class="  px-2"><a :href="'https://'+hospital.domain">{{ hospital.domain }}</a></div>
            </div>
          </div>

        </div>
      </div>
    </div>


  </div>
</template>

<script>

export default {
  props: ['hospitals'],

  data() {
    return {}
  },

  created() {

    console.log(this.hospitals)
  },
  mounted() {
  },

  methods: {},


}
</script>