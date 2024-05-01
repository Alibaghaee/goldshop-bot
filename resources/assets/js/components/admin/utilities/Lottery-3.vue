<template>

    <div class="relative font-black" style="min-height: 1030px; font-family: dana-fanum;" tabindex="0" @keydown.left="previousPage" @keydown.right="nextPage">
        <img class="absolute pin-x pin-y w-full pb-6" :src="background" style="" alt="">
        <div class="absolute text-white p-8 w-full" v-if="step == 1">
            <div class="mx-auto w-full">
                <div class="w-full">
                    <img class="mx-auto block md:w-4/5" src="/image/admin/docharke/text-1.png" alt="">
                    <!-- <div class="text-center text-6xl font-black mt-6" style="font-family: Vazirmatn;font-weight: 900;">قرعه کشی جشنواره ویژه خندوانه</div> -->

                    <div class="flex text-5xl font-black justify-center mt-10">
                        <input class="w-28 h-28 rounded-md mx-4 text-center text-6xl font-black ltr" type="text" v-model="digit_1">
                        <input class="w-28 h-28 rounded-md mx-4 text-center text-6xl font-black ltr" type="text" v-model="digit_2">
                        <input class="w-28 h-28 rounded-md mx-4 text-center text-6xl font-black ltr" type="text" v-model="digit_3">
                        <input class="w-28 h-28 rounded-md mx-4 text-center text-6xl font-black ltr" type="text" v-model="digit_4">
                        <input class="w-28 h-28 rounded-md mx-4 text-center text-6xl font-black ltr" type="text" v-model="digit_5">
                        <!-- <input class="w-28 h-28 rounded-md mx-4 text-center text-6xl font-black ltr" type="text" v-model="digit_6"> -->
                        <!-- <input class="w-28 h-28 rounded-md mx-4 text-center text-6xl font-black ltr" type="text" v-model="digit_7"> -->
                        <div class="h-28 rounded-md bg-red flex justify-center items-center px-8 cursor-pointer hover:bg-red-dark mr-4" @click="checkInputs()">جستجو</div>
                    </div>
                </div>

                <!-- <div class="flex items-center justify-center mt-12 w-5/6 mx-auto">
                    <div class="w-3/4">
                        <img class="" src="/image/admin/docharke/50-1.png" jpg="">
                    </div>
                    <div class="w-1/4">
                        <div class="bg-red rounded-md border-4 border-white p-3 font-black">
                            <div class="text-2xl text-center">تعداد کل شرکت کنندگان</div>
                            <div class="text-5xl text-center leading-none mt-1 tracking-wide">331190 نفر</div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>

        <div class="absolute text-white p-8 w-full" v-if="step == 2">
            <div class="mx-auto">
                <!-- <div>
                    <div class="text-center text-6xl font-black mt-6" style="font-family: Vazirmatn;font-weight: 900;">قرعه کشی جشنواره ویژه خندوانه</div>
                </div> -->

                <div class="flex justify-center mt-12 mx-auto">
                    <div class="w-full">
                        <div class="text-4xl font-black leading-normal">
                            
                            <transition-group tag="ul" name="list" class="p-0 flex flex-wrap px-4">
                                <div class="w-1/2 flex flex-col mb-6 px-6" v-for="winners, index in winners_chunked" v-bind:key="index">
                                    <div class="flex mb-6" v-for="winner in winners" v-bind:key="winner._id">
                                        <div class="flex w-1/2">
                                            <div class="w-1/5 text-center bg-red text-white rounded-r-md px-2 py-3 ml-2">{{ winner.id }}</div>
                                            <div class="w-4/5 text-center bg-white text-red px-2 py-3 ltr tracking-wide">{{ winner.mobile_masked }}</div>
                                        </div>
                                        <div class="flex w-1/2">
                                            <div class="w-1/3 text-center bg-red text-white px-2 py-3 mr-2">ردیف</div>
                                            <div class="w-2/3 text-center bg-white text-red rounded-l-md px-2 py-3 ltr tracking-wide">{{ winner.total_id }}</div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </transition-group>
                            
                        </div>
                    </div>
                    <!-- <div class="w-1/3 pr-12">
                        <img src="/image/admin/docharke/box-1.png" jpg="">
                    </div> -->
                </div>

            </div>
        </div>

        <div class="absolute border-2 border-orange-light mx-auto pin-b pin-x rounded-lg text-5xl text-center text-white w-1/2 z-50 mb-4 font-black" style="background-color: #598121;" v-if="step == 2">
            برندگان خوش شانس دوچرخه <span class="text-orange-light">{{ (page - 1) * perpage + 1 }} تا {{ end_index }}</span>
        </div>

    </div>

</template>

<script>
    export default {
        props: ['count'],
        
        // temp
        data() {
            return {
                step: 1,
                page: 1,
                perpage: 14,
                chunk_count: 7,
                start_index: 0,
                end_index: 0,
                digit_1 : '',
                digit_2 : '',
                digit_3 : '',
                digit_4 : '',
                digit_5 : '',
                digit_6 : '',
                digit_7 : '',
                winners : [],
            }
        },

        computed: {
            winner_id (){
                let digit = this.digit_7 + this.digit_6 + this.digit_5 + this.digit_4 + this.digit_3 + this.digit_2 +  this.digit_1;
                return digit;
            },
            background (){
                if (this.step == 1) {
                    return '/image/admin/docharke/tabiat_bg_1.jpg'
                }
                return '/image/admin/docharke/tabiat_bg_2.jpg'
            },
            winners_chunked (){
                this.start_index = (this.page - 1) * this.perpage
                this.end_index   = this.page * this.perpage
                this.end_index = this.end_index <= 100 ? this.end_index : 100
                let data        = _.slice(this.winners, this.start_index, this.end_index);
                return _.chunk(data, this.chunk_count)
            },
        },

        methods: {
            checkInputs (){
                // this.step = 2
                this.sendData()
            },
            sendData (){
                axios['post']('/lottery',{ winner_id: this.winner_id })
                .then(response => {
                    console.log(response.data)

                    this.step = 2

                    let data = response.data 
                    data.forEach(function (item, index) {
                        setTimeout(function () {
                            this.winners.push(item)
                            if (this.winners.length % this.perpage == 0) {
                                setTimeout(function () {
                                    ++this.page
                                }.bind(this), 500)
                            }
                        }.bind(this), 500 * index);
                    }.bind(this))

                    // this.winners = response.data
                })
                .catch(error => {
                  flash('خارج از محدوده مجاز', 'info')
                });
            },
            nextPage(){
                console.log(this.page)
                this.page++
            },
            previousPage(){
                console.log(this.page)
                this.page = this.page > 1 ? --this.page : 1
            },
            
        }
    }

</script>