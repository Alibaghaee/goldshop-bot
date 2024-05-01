<template>

    <div class="relative">
        <img class="absolute pin-x pin-y w-full pb-6" src="/image/admin/tabiat_bg_1.png" style="" alt="">
        <div style="width: 94%;" class="absolute text-white p-8" v-if="step == 1">
            <div class="mx-auto">
                <div>
                    <div class="text-center text-6xl font-extrabold mt-6" style="font-family: Vazirmatn;font-weight: 900;">قرعه کشی جشنواره ویژه خندوانه</div>

                    <div class="flex text-5xl font-extrabold justify-center mt-10">
                        <input class="w-28 h-28 rounded-md mx-4 text-center text-6xl font-extrabold ltr" type="text" v-model="digit_1">
                        <input class="w-28 h-28 rounded-md mx-4 text-center text-6xl font-extrabold ltr" type="text" v-model="digit_2">
                        <input class="w-28 h-28 rounded-md mx-4 text-center text-6xl font-extrabold ltr" type="text" v-model="digit_3">
                        <input class="w-28 h-28 rounded-md mx-4 text-center text-6xl font-extrabold ltr" type="text" v-model="digit_4">
                        <input class="w-28 h-28 rounded-md mx-4 text-center text-6xl font-extrabold ltr" type="text" v-model="digit_5">
                        <input class="w-28 h-28 rounded-md mx-4 text-center text-6xl font-extrabold ltr" type="text" v-model="digit_6">
                        <!-- <input class="w-28 h-28 rounded-md mx-4 text-center text-6xl font-extrabold ltr" type="text" v-model="digit_7"> -->
                        <div class="h-28 rounded-md bg-red flex justify-center items-center px-8 cursor-pointer hover:bg-red-dark mr-4" @click="checkInputs()">جستجو</div>
                    </div>
                </div>

                <div class="flex items-center justify-center mt-12 w-5/6 mx-auto">
                    <div class="w-3/4">
                        <img class="" src="/image/admin/50-1.png" alt="">
                    </div>
                    <div class="w-1/4">
                        <div class="bg-red rounded-md border-4 border-white p-3 font-bold">
                            <div class="text-2xl text-center">تعداد کل شرکت کنندگان</div>
                            <div class="text-5xl text-center leading-none mt-1 tracking-wide">331190 نفر</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="width: 94%;" class="absolute text-white p-8" v-if="step == 2">
            <div class="mx-auto">
                <div>
                    <div class="text-center text-6xl font-extrabold mt-6" style="font-family: Vazirmatn;font-weight: 900;">قرعه کشی جشنواره ویژه خندوانه</div>
                </div>

                <div class="flex justify-center mt-12 w-5/6 mx-auto">
                    <div class="w-2/3">
                        <div class="text-4xl font-extrabold leading-normal">
                            
                            <transition-group tag="ul" name="list">
                                <div class="flex mb-6" v-for="winner in winners" v-bind:key="winner._id">
                                    <div class="w-1/2 text-center bg-red text-white rounded-r-md px-2 py-3 ml-2">برنده خوش شانس {{ winner.position }}</div>
                                    <div class="w-1/2 text-center bg-white text-red rounded-l-md px-2 py-3 ltr tracking-wide">{{ winner.mobile_masked }}</div>
                                </div>
                            </transition-group>
                            
                        </div>
                    </div>
                    <div class="w-1/3 pr-12">
                        <img src="/image/admin/box-1.png" alt="">
                    </div>
                </div>

            </div>
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
            }
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
                        }.bind(this), 3000 * index);
                    }.bind(this))

                    // this.winners = response.data
                })
                .catch(error => {
                  flash('خارج از محدوده مجاز', 'info')
                });
            }
        }
    }

</script>