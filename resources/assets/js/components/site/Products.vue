<template>
    <div class="container leading-loose mt-0 py-4 md:py-8 md:mt-8 h-screen">
        <div class="flex flex-wrap -mx-2">
            <div class="w-full md:w-1/5 px-2">
              <form @submit.prevent="" @keydown="form.errors.clear($event.target.name)">
                  <input 
                    class="rhc-form-control mb-6 shadow" 
                    autocomplete=off
                    type="text" 
                    name="title" 
                    placeholder="جستجو در عنوان" 
                    v-model="form_data['title']"
                    @keyup="submit"
                  >
                  <div class="shadow bg-grey-lightest rounded mb-6 border-t border-grey-lighter" v-for="category in categories" v-if="category.items.length">
                      <div class="bg-white font-bold p-2 px-4 rounded shadow text-grey-darkest text-xl">{{ category.title }}</div>
                      <div class="p-4 py-6 inline-block -mb-4">
                          <div v-for="item in category.items">
                            <div class="md:flex md:items-center mb-4">
                              <div class="flex items-center">
                                <input 
                                  type="checkbox" 
                                  :name="item.id" 
                                  :id="item.id" 
                                  class="h-4 ml-2 w-4 cursor-pointer" 
                                  v-model="form_data['tags'][item.id]"
                                  @change="submit"
                                />
                                <label class="block leading-tight text-purple-darkest cursor-pointer" :for="item.id">
                                  {{ item.title }}
                                </label>
                              </div>
                            </div>
                          </div>
                      </div>
                  </div>
              </form>
            </div>
            <div class="w-full md:w-4/5 px-2" v-if="products_data.length > 0">
                <div class="flex flex-wrap -mx-2">
                      <div class="w-full md:w-1/3 px-0 mb-6 px-2" v-for="product in products_data">
                          <div class="bg-white shadow flex flex-wrap rounded">
                              <div class="flex justify-center items-center w-full">
                                  <a :href="product.product_show_page" class="w-full" v-if="product.image">
                                      <img :src="product.image" class="w-full rounded-t" :alt="product.title">
                                  </a>
                              </div>
                              <div class="flex flex-col p-3 px-4 rounded w-full">
                                  <div class="flex flex-col py-3 border-b-2 border-grey-lighter w-full">
                                      <a :href="product.product_show_page" class="no-underline font-bold text-xl text-purple-darkest hover:text-purple-dark w-full">{{ product.title }}</a>
                                      <!-- <div class="text-green font-medium">{{ product.price }} ریال</div> -->
                                  </div>
                                  <div class="py-3 border-b-2 border-grey-lightest" v-html="product.detail_substr"></div>
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
                                  <!-- <div class="w-full flex justify-end">
                                      <div @click="addToCart(product.id)" class="border-2 border-purple-dark cursor-pointer flex h-12 hover:bg-purple-dark hover:text-white items-center justify-center leading-normal rounded text-purple-dark text-white w-32">ثبت سفارش</div>
                                  </div> -->
                              </div>
                          </div>
                      </div>
                </div>
                <div class="w-full mt-8">
                    <!-- {!! $products->links() !!} -->
                </div>
            </div>
            <div class="w-full md:w-4/5 px-2" v-else>
              <div class="text-center text-grey text-4xl">متاسفانه نتیجه ای یافت نشد</div>
              <img class="mx-auto block" src="/image/site/no_search_results.jpg" alt="no_search_results">
            </div>
        </div>
    </div>
</template>

<script>
import { Form, FormErrors } from './../../form.js';

export default {

  props: ['products', 'categories', 'active_tags'],

  data () {
    return {
      form_data: {
        tags : this.active_tags
      },
      form: new Form(this.form_data),
      products_data : this.products,
    }
  },

  methods: {
    submit(){
        this.loading = true
        this.form = new Form(this.form_data)

        axios.post('/fa/products/search', this.form_data)
        .then(function (response){
          this.products_data = response.data.data;
        }.bind(this))
        .catch(function (error){
          //
        }.bind(this))
    },
  }
}
</script>