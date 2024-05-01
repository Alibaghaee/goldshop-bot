<template>
  <div class="flex flex-wrap -mx-3 mb-8 ">
      <div v-for="(image, index) in gallery_images" class="w-full md:w-1/4 px-3">
          <img v-lazy="image.thumb" @click="openGallery(index)" class="cursor-pointer rounded shadow-md w-full" :alt="image.title">
      </div>
      <LightBox 
        :images="gallery_images" 
        ref="lightbox"
        :show-caption="false"
        :show-light-box="false"
      >
      </LightBox>
  </div>

</template>

<script>
import LightBox from 'vue-image-lightbox'

// import siteLoading from './siteloading.gif'

export default {
  components: {
    LightBox,
  },

  props: ['images'],

  data () {
    return {
      gallery_images : this.images
    }
  },

  methods: {
    openGallery(index) {
      this.$refs.lightbox.showImage(index)
    }
  }
}
</script>