<template>
    <div class="relative w-full" style="font-family: dana-fanum;">
        <img class="absolute pin-x pin-y w-full" src="/image/admin/zojino/bg-1.png" style="" alt="">
        <div style="width: 94%;" class="absolute text-white p-8" v-if="step == 1">
            <div class="mx-auto">
                <div>
                    <img src="/image/admin/zojino/title-1.png" style="max-width: 750px;" class="flex mx-auto" alt="">

                    <div class="flex text-5xl font-extrabold justify-center">
                        <input class="w-32 h-32 rounded-md mx-4 text-center text-6xl font-extrabold ltr" type="text" v-model="digit_1">
                        <input class="w-32 h-32 rounded-md mx-4 text-center text-6xl font-extrabold ltr" type="text" v-model="digit_2">
                        <input class="w-32 h-32 rounded-md mx-4 text-center text-6xl font-extrabold ltr" type="text" v-model="digit_3">
                        <input class="w-32 h-32 rounded-md mx-4 text-center text-6xl font-extrabold ltr" type="text" v-model="digit_4">
                        <input class="w-32 h-32 rounded-md mx-4 text-center text-6xl font-extrabold ltr" type="text" v-model="digit_5">
                        <input class="w-32 h-32 rounded-md mx-4 text-center text-6xl font-extrabold ltr" type="text" v-model="digit_6">
                        <input class="w-32 h-32 rounded-md mx-4 text-center text-6xl font-extrabold ltr" type="text" v-model="digit_7">
                        <div class="h-32 rounded-md bg-green flex justify-center items-center px-8 cursor-pointer hover:bg-green-dark mr-4 text-6xl" @click="checkInputs()">جستجو</div>
                    </div>
                </div>

                <div class="flex items-center justify-center w-5/6 mx-auto">
                    <div class="">
                        <img class="px-16" src="/image/admin/zojino/title-2.png" style="max-width: 870px;" alt="">
                    </div>
                    <div class="border-2 rounded" style="border-color: rgb(6 249 8); padding: 0.08rem; box-shadow: 0px 0px 7px #ffffffa3;">
                        <div class="rounded border-2 p-3 font-bold" style="background-color: rgb(17 212 18 / 32%); border-color: rgb(6 249 8); box-shadow: 0px 0px 7px #ffffffa3;">
                            <div class="text-4xl text-center">تعداد شرکت کنندگان</div>
                            <div class="text-5xl text-center leading-none mt-1">{{ Intl.NumberFormat().format(lottery.count) }} نفر</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute text-white p-8 w-full font-black" v-if="step == 2">
            <div class="mx-auto">
                <div class="flex flex-wrap">
                    <div class="w-1/2">
                        <div>
                            <img src="/image/admin/zojino/title-1.png" style="max-width: 750px;" class="flex mx-auto" alt="">
                        </div>

                        <div class="text-4xl leading-normal mx-auto" style="max-width: 650px;">

                            <transition name="fade" mode="out-in" appear>
                                <div v-if="show_result == true">
                                    <div class="border-2 rounded mx-auto" style="border-color: rgb(6 249 8); padding: 0.08rem; box-shadow: 0px 0px 7px #ffffffa3;">
                                        <div class="rounded border-2 p-1" style="background-color: rgb(17 212 18 / 32%); border-color: rgb(6 249 8); box-shadow: 0px 0px 7px #ffffffa3;">
                                            <div class="bg-green p-3 px-0 rounded-t-md text-5xl text-center">برنده خوش شانس مرحله {{ lottery.step }}</div>
                                            <div class="bg-white leading-none leading-normal ltr pt-4 rounded-b-lg text-6xl text-center text-green-dark" style="font-size: 68px;">{{ winner.mobile_masked }}</div>
                                        </div>
                                    </div>
                                    <div class="px-0">
                                        <div class="flex mb-6 mt-10">
                                            <div class="w-1/3 text-center bg-green text-white rounded-r-md px-2 py-3 text-2xl rahco-center">کد قرعه کشی</div>
                                            <div class="w-2/3 text-center bg-white text-green-dark rounded-l-md px-2 pt-3 ltr text-5xl">{{ winner.code }}</div>
                                        </div>
                                        <div class="flex mb-6">
                                            <div class="w-1/3 text-center bg-green text-white rounded-r-md px-2 py-3 text-2xl rahco-center">ردیف</div>
                                            <div class="w-2/3 text-center bg-white text-green-dark rounded-l-md px-2 pt-3 ltr text-5xl">{{ winner.total_id }}</div>
                                        </div>
                                        <div class="flex mb-6">
                                            <div class="w-1/3 text-center bg-green text-white rounded-r-md px-2 py-3 text-base rahco-center">تعداد شرکت کنندگان</div>
                                            <div class="w-2/3 text-center bg-white text-green-dark rounded-l-md px-2 pt-3 ltr text-5xl">{{ Intl.NumberFormat().format(lottery.count) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </transition>
                        </div>

                    </div>
                    <div class="w-1/2">
                        <img src="/image/admin/zojino/box-50.png" class="flex mx-auto w-full" style="max-width: 739px;" alt="">
                    </div>
                </div>

            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['lottery'],
        
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
                winner : {},
                show_result : false,
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
                axios['post'](this.lottery.run_lottery_uri ,{ winner_id: this.winner_id })
                .then(response => {
                    console.log(response.data)

                    this.step = 2

                    this.winner = response.data
                    setTimeout(function () {
                        this.show_result = true
                    }.bind(this), 300);

                })
                .catch(error => {
                  flash('خارج از محدوده مجاز', 'info')
                });
            }
        }
    }

</script>


<style>
    .fade-enter-active, .fade-leave-active {
      transition: opacity 3s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
      opacity: 0;
    }
</style>