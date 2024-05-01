<template>
    <div class="w-full flex flex-wrap mb-12">
        <div v-if="total_count ==0" class="flex flex-wrap justify-center w-full">
            <div class="w-full text-center text-4xl text-grey-dark mb-6">سبد خرید شما خالیه!</div>
            <img class="max-w-md" src="/image/site/empty_cart.png" alt="empty_cart">
        </div>
        <div class="w-full flex shadow-md my-10 rounded" v-else>
              <div class="w-3/4 bg-white p-8 rounded">
                <div class="flex justify-between border-b pb-8">
                  <h1 class="font-semibold text-2xl">سبد خرید</h1>
                  <h2 class="font-semibold text-2xl">{{ formatNumber(total_count) }} محصول</h2>
                </div>
                <div class="flex mt-10 mb-5">
                  <h3 class="font-semibold text-grey-dark text-sm w-2/5">جزئیات محصول</h3>
                  <h3 class="font-semibold text-center text-grey-dark text-sm w-1/5 text-center">تعداد</h3>
                  <h3 class="font-semibold text-center text-grey-dark text-sm w-1/5 text-center">قیمت</h3>
                  <h3 class="font-semibold text-center text-grey-dark text-sm w-1/5 text-center">مجموع</h3>
                </div>


                <div class="flex items-center hover:bg-grey-lighter -mx-8 px-6 py-6" v-for="item in cart">
                  <div class="flex w-2/5"> <!-- product -->
                    <div class="w-48">
                      <a :href="item.options.link">
                          <img class="h-24 rounded" :src="item.options.image" :alt="item.name">
                      </a>
                    </div>
                    <div class="flex flex-col justify-between ml-4 flex-grow">
                        <a :href="item.options.link" class="no-underline">
                            <span class="font-bold text-sm">{{ item.name }}</span>
                        </a>
                      <div @click="remove(item)" class="font-semibold hover:text-red text-grey-darker text-xs no-underline cursor-pointer ml-auto">
                            <svg class="fill-current w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 383.9999694824219"><path d="M261 64V35c0-19.1-14.5-35-34.5-35H125.4C105.5 0 91 15.9 91 35v29H0v32h9.2s5.4.6 8.2 3.4c2.8 2.8 3.9 9 3.9 9l19 241.7c1.5 29.4 1.5 33.9 36 33.9h199.4c34.5 0 34.5-4.4 36-33.8l19-241.6s1.1-6.3 3.9-9.1 8.2-3.4 8.2-3.4h9.2v-32h-91V64zM112 35c0-9.6 7.8-15 17.7-15h91.7c9.9 0 18.6 5.5 18.6 15v29H112V35zm-8.5 285L93.2 128h20.3L124 320h-20.5zm83.6 0h-22V128h22v192zm61.6 0h-20.4l10.5-192h20.3l-10.4 192z"/></svg>
                            حذف
                      </div>
                    </div>
                  </div>
                  <div class="flex justify-center items-center w-1/5">
                    <svg @click="decrease(item)" class="cursor-pointer fill-current flex h-10 w-10 px-3 text-grey-dark" viewBox="0 0 448 512"><path d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                    </svg>

                    <input class="mx-2 border text-center w-12 h-10 rounded" type="text" :value="item.qty" @keyup="update(item, $event.target.value)">

                    <svg @click="increase(item)" class="cursor-pointer fill-current flex h-10 w-10 px-3 text-grey-dark" viewBox="0 0 448 512">
                      <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                    </svg>
                  </div>
                  <span class="text-center w-1/5 font-semibold text-sm">{{ formatNumber(item.price) }} ریال</span>
                  <span class="text-center w-1/5 font-semibold text-sm">{{ formatNumber(item.subtotal) }} ریال</span>
                </div>

                <div class="flex flex-wrap justify-between items-center mt-10">
                    <div>
                        <a href="/" class="font-semibold text-indigo-600 text-smno-underline block">
                          <svg class="fill-current ml-2 text-indigo-600 w-4 align-middle" viewBox="0 0 448 512"><path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/></svg>
                          ادامه خرید
                        </a>
                    </div>
                    <div>
                        <div class="font-semibold text-base text-red cursor-pointer" @click="destroy">
                            <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 383.9999694824219"><path d="M261 64V35c0-19.1-14.5-35-34.5-35H125.4C105.5 0 91 15.9 91 35v29H0v32h9.2s5.4.6 8.2 3.4c2.8 2.8 3.9 9 3.9 9l19 241.7c1.5 29.4 1.5 33.9 36 33.9h199.4c34.5 0 34.5-4.4 36-33.8l19-241.6s1.1-6.3 3.9-9.1 8.2-3.4 8.2-3.4h9.2v-32h-91V64zM112 35c0-9.6 7.8-15 17.7-15h91.7c9.9 0 18.6 5.5 18.6 15v29H112V35zm-8.5 285L93.2 128h20.3L124 320h-20.5zm83.6 0h-22V128h22v192zm61.6 0h-20.4l10.5-192h20.3l-10.4 192z"/></svg>
                            پاک کردن همه
                        </div>
                    </div>
                </div>
              </div>

              <div id="summary" class="w-1/4 p-8 bg-grey-lighter rounded">
                <h1 class="font-semibold text-2xl border-b pb-8">خلاصه سفارش</h1>
                <div class="flex justify-between mt-10 mb-5">
                  <span class="font-semibold text-sm uppercase">{{ formatNumber(total_count) }} محصول</span>
                  <span class="font-semibold text-sm">{{ formatNumber(total_price) }} ریال</span>
                </div>
                <div class="mt-8">
                  <label class="font-medium inline-block mb-3 text-sm uppercase">نحوه ارسال</label>
                  <select class="block p-2 text-grey-dark w-full text-sm" name="shipping_type" v-model="shipping_type">
                    <option v-for="shipping in shipping_types" :value="shipping.id">{{ shipping.price }} {{ shipping.name }}</option>
                  </select>
                </div>
                <div class="border-t mt-8">
                  <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                    <span>مبلغ کل</span>
                    <span>{{ formatNumber(total_price_with_shipping) }} ریال</span>
                  </div>
                  <button class="no-underline bg-green-light hover:bg-green rounded py-2 px-6 text-white cursor-pointer h-12 flex items-center justify-center w-32 text-center w-full" @click="pay()">پرداخت</button>
                </div>
              </div>

            </div>
    </div>
</template>

<script>
    import accounting from 'accounting'
    export default {
        props: ['shipping_types'],
        data () {
            return {
                cart: window.App.cart,
                shipping_type: 1,
            }
        },
        methods: {
            pay (){
                axios['post']('/fa/cart/pay', {'shipping_type' : this.shipping_type})
                .then(response => {
                    // window.location = response.data.redirect
                })
            },
            updateContent (){
                axios['post']('/fa/cart/content')
                .then(response => {
                    window.events.$emit('update-cart', response.data)
                    this.cart = response.data
                })
            },
            update (item, count){
                axios['post']('/fa/cart/update', {'row_id' : item.rowId, 'count' : parseInt(count)})
                .then(response => {
                    this.updateContent()
                })
            },
            destroy (){
                axios['post']('/fa/cart/destroy')
                .then(response => {
                    this.updateContent()
                })
            },
            remove (item){
                axios['post']('/fa/cart/remove', {'row_id' : item.rowId})
                .then(response => {
                    this.updateContent()
                })
            },
            decrease (item){
                let count = parseInt(item.qty) > 1 ? parseInt(item.qty) - 1 : 1
                this.update(item, count);
            },
            increase (item){
                let count = parseInt(item.qty) + 1
                this.update(item, count);
            },
            formatNumber (value) {
              return accounting.formatNumber(value, 0)
            }
        },

        computed : {
          total_count (){
            return _.sumBy(Object.values(this.cart), 'qty')
          },
          total_price (){
            return _.sumBy(Object.values(this.cart), 'subtotal')
          },
          total_price_with_shipping (){
            return this.total_price + _.find(this.shipping_types, {id: this.shipping_type}).price
          },
        },
    }
</script>