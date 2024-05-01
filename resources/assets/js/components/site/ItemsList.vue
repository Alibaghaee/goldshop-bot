<template>
    <div class="container md:py-8 md:my-8 leading-loose text-black">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full md:w-2/5 px-4">
                <img :src="product.image" :alt="product.title" class="w-full rounded">
            </div>
            <div class="w-full md:w-3/5 px-4 flex flex-wrap md:-mx-4">
                <div class="w-full md:w-1/2 md:px-4">
                    <nav class="w-full opacity-75 mb-3">
                      <ol class="list-reset flex text-grey-dark">
                        <li><a href="/fa/products" class="no-underline cursor-pointer text-purple-darkest hover:text-purple-darker">محتوای آموزشی</a></li>
                      </ol>
                    </nav>
                    <h1 class="text-3xl m-0 mb-8 font-bold leading-normal">{{ product.title }}</h1>
                    <div>
                        <div class="text-grey-darker font-medium mb-4" v-html="product.detail"></div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 md:px-4">
                    <div class="font-bold text-xl">توضیحات:</div>
                    <div v-html="product.description"></div>
                    <div class="mt-8 flex flex-wrap">
                        <template v-if="product.tags.length > 0">
                          <div class="font-bold mb-2 ml-2">برچسب ها:</div>
                              <a v-for="tag in product.tags" :href="tag.link" class="no-underline border-2 border-purple-dark cursor-pointer flex px-4 text-sm hover:bg-purple-dark hover:text-white items-center justify-center rounded text-purple-dark h-8 mx-1">
                                  {{ tag.title }}
                              </a>
                        </template>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap px-4 w-full mt-8 md:-mx-4">
                <div class="w-full md:w-3/4 -mb-4 md:px-4">
                  <div class="border-b-2 border-grey-lighter flex mb-4 text-xl">
                    <div @click="active_tab = 1" class="hover:bg-grey-light cursor-pointer rounded-t px-3" :class="[ active_tab == 1 ? 'text-grey-darkest bg-grey-light' : 'text-grey-dark bg-grey-lighter' ]">فیلم ها</div>
                    <div @click="active_tab = 2" class="hover:bg-grey-light cursor-pointer rounded-t px-6 mr-3" :class="[ active_tab == 2 ? 'text-grey-darkest bg-grey-light' : 'text-grey-dark bg-grey-lighter' ]">جزوات</div>
                  </div>
                  <input type="text" class="rhc-form-control outline-none shadow-inner mb-4" placeholder="جستجو" v-model="search">
                  <a v-if="active_tab == 1" v-for="item in items" :href="item.video_page_url" class="no-underline text-grey-darkest text-orange hover:text-green rounded mb-4 flex hover-shadow w-full p-4 justify-between items-center" style="background-color: #f6f8fa;">
                      <div class="flex flex-wrap items-center text-grey-darkest">
                          <img class="w-full md:w-48 rounded hidden sm:block" :src="item.cover" :alt="item.title">
                          <div class="mr-4 text-xl">{{ item.title }}</div>
                      </div>
                      <div class="flex">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 fill-current cursor-pointer" viewBox="0 0 40 40"><path d="M20 0C8.95 0 0 8.95 0 20s8.95 20 20 20 20-8.95 20-20S31.05 0 20 0zm-4 29V11l12 9-12 9z"/></svg>
                      </div>
                  </a>

                  <a v-if="active_tab == 2" v-for="item in items" :href="item.jozveh_path" class="no-underline text-grey-darkest text-orange hover:text-green rounded mb-4 flex hover-shadow w-full p-4 justify-between items-center" style="background-color: #f6f8fa;">
                      <div class="flex flex-wrap items-center text-grey-darkest">
                          <img class="w-full md:w-48 rounded hidden sm:block" :src="item.cover" :alt="item.title">
                          <div class="mr-4 text-xl">{{ item.title }}</div>
                      </div>
                      <div class="flex">
                        <svg class="w-16 h-16 fill-current cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 480 320"><path d="M387.002 121.001C372.998 52.002 312.998 0 240 0c-57.998 0-107.998 32.998-132.998 81.001C47.002 87.002 0 137.998 0 200c0 65.996 53.999 120 120 120h260c55 0 100-45 100-100 0-52.998-40.996-96.001-92.998-98.999zM208 172V96h64v76h68L240 272 140 172h68z"/></svg>
                      </div>
                  </a>
                </div>

                <div class="w-full md:w-1/4 md:px-4 mt-8 md:mt-0">
                    <div class="font-bold text-xl mb-4 border-2 border-white">محتوای مرتبط</div>
                        <a v-for="product in related_products" :href="product.product_show_page" class="no-underline text-grey-darkest hover:text-black rounded mb-4 flex flex-wrap hover-shadow" style="background-color: #f6f8fa;">
                            <img class="rounded" :src="product.image">
                            <div class="p-4 w-full">
                                <div class="w-full">{{ product.title }}</div>
                                <div class="flex flex-row pt-3 w-full font-medium justify-between">
                                    <div class="ml-12 flex items-baseline">
                                        <div class="flex justify-center items-center bg-grey-lighter rounded-full w-4 h-4 ml-1">
                                            <svg class="w-2 h-2 fill-current text-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1026.666748046875 1024"><path d="M1021.833 385.5q-6.5-21.5-23-36t-38.5-17.5l-262-40-117-248q-10-20-28-32t-40-12-40 12-28 32l-117 248-262 40q-22 3-38.5 17.5t-23 36-1.5 43 21 37.5l190 193-45 273q-4 22 4 43t26 34q20 15 44 15 19 0 36-9l234-129 235 129q16 9 35 9 25 0 44-15 18-13 26-34t4-43l-44-273 189-193q16-15 21-37t-1.5-43.5z"/></svg>
                                        </div>
                                        {{ product.video_count }} ویدئو
                                    </div>
                                    <div class="flex items-baseline">
                                        <div class="flex justify-center items-center bg-grey-lighter rounded-full w-4 h-4 ml-1">
                                            <svg class="w-2 h-2 fill-current text-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1026.666748046875 1024"><path d="M1021.833 385.5q-6.5-21.5-23-36t-38.5-17.5l-262-40-117-248q-10-20-28-32t-40-12-40 12-28 32l-117 248-262 40q-22 3-38.5 17.5t-23 36-1.5 43 21 37.5l190 193-45 273q-4 22 4 43t26 34q20 15 44 15 19 0 36-9l234-129 235 129q16 9 35 9 25 0 44-15 18-13 26-34t4-43l-44-273 189-193q16-15 21-37t-1.5-43.5z"/></svg>
                                        </div>
                                        {{ product.article_count }} جزوه
                                    </div>
                                    <!-- <div class="ml-12 flex items-baseline">
                                        <div class="flex justify-center items-center bg-grey-lighter rounded-full w-4 h-4 ml-1">
                                            <svg class="w-2 h-2 fill-current text-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 638 1030"><path d="M68 13l558 476q12 11 12 26t-12 26L68 1017q-19 16-43.5 7T0 991V39Q0 15 24.5 6T68 13z"/></svg>
                                        </div>
                                        9K بازدید
                                    </div> -->
                                </div>
                            </div>
                        </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {

  props: ['product', 'related_products'],

  data () {
    return {
      items : this.product.items,
      search: '',
      active_tab: 2,
    }
  },

  created() {
    this.active_tab = 1
  },

  methods: {
    submit(){
        //
    },
  },

  computed: {
    filted_items(){
        return _.filter(this.product.items, function(item) {
            return _.includes(item.title, this.search) && item.type == this.active_tab
       }.bind(this))
    },

    rested_items(){
        return _.filter(this.product.items, function(item) {
            return item.type == this.active_tab
        }.bind(this))
    }
  },

  watch : {
      search (val){
          if (val.length != 0) {
              this.items = this.filted_items;
              return;
          }else{
            this.items = this.rested_items;
            return;
          }
      },
      active_tab (val){
          this.items = this.product.items
          if (val == 1) {
              this.items = this.filted_items;
              return;
          }
          if (val == 2) {
              this.items = this.filted_items;
              return;
          }
      },
      
  },
}
</script>