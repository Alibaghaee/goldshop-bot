<script>

import {ref} from 'vue'


export default {

    props: {
        'intylist': {
            type: Object
        },
    },
    data() {
        return {
            Inty: null,
            Indati2m: null,
            Indatim: null,
            Tprdis: null,
            Tdis: null,
            Tadis: null,
            Tvam: null,
            Todam: null,
            Tbill: null,
            Tax17: null,
            Sstid: null,
            Am: null,
            Sstt: null,
            Mu: null,
            Fee: null,
            Dis: null,
            Vra: null,

        }
    },
    // `setup` is a special hook dedicated for the Composition API.
    setup(props) {


    },
    mounted: function () {

    },
    methods: {

        submit() {
            let formData = new FormData();
            const config = {
                headers: {
                    'content-type': 'application/json'
                }
            }
            formData.append('title', this.title);

            //
            axios.post('testtest', data, config)
                .then((response) => {
                    console.warn(response)
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    }
}

</script>

<template>

    <form @submit.prevent="submit()" method="post">

        <div class="grid  grid-cols-1 sm:grid-cols-3 lg:grid-cols-5 ">

            <div class=" flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                <div class="text-white p-1">تاریخ و زمان ایجاد
                    صورتحساب
                </div>
                <date-picker v-model="Indati2m"></date-picker>
            </div>

            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                <div class="text-white p-1">تاریخ و زمان صدور
                    صورتحساب
                </div>
                <date-picker v-model="Indatim"></date-picker>
            </div>
            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400" v-if="intylist">
                <div class="text-white p-1">نوع صورتحساب</div>

                <select name="Inty" v-model="Inty">
                    <option disabled value="">انتخاب کنید</option>

                    <option :value="inty['id']" v-for="inty in intylist">{{ inty['name'] }}</option>

                </select>


            </div>

<!--            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">-->
<!--                <div class="text-white p-1">مجموع مبلغ قبل از-->
<!--                    كسر تخفیف-->
<!--                </div>-->
<!--                <input type="text" class="p-2 rounded" name="Tprdis" v-model="Tprdis">-->
<!--            </div>-->

<!--            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">-->
<!--                <div class="text-white p-1">مجموع تخفیفات</div>-->
<!--                <input type="text" class="p-2 rounded" name="Tdis" v-model="Tdis">-->
<!--            </div>-->

<!--            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">-->
<!--                <div class="text-white p-1">مجموع مبلغ پس از-->
<!--                    كسر تخفیف-->
<!--                </div>-->
<!--                <input type="text" class="p-2 rounded" name="Tadis" v-model="Tadis">-->
<!--            </div>-->

<!--            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">-->
<!--                <div class="text-white p-1">مجموع مالیات بر ارزش-->
<!--                    افزوده-->
<!--                </div>-->
<!--                <input type="text" class="p-2 rounded" name="Tvam" v-model="Tvam">-->
<!--            </div>-->

<!--            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">-->
<!--                <div class="text-white p-1">مجموع سایر مالیات،-->
<!--                    عوارض و وجوه قانونی-->
<!--                </div>-->
<!--                <input type="text" class="p-2 rounded" name="Todam" v-model="Todam">-->
<!--            </div>-->


<!--            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">-->
<!--                <div class="text-white p-1">مجموع صورتحساب</div>-->
<!--                <input type="text" class="p-2 rounded" name="Tbill" v-model="Tbill">-->
<!--            </div>-->

<!--            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">-->
<!--                <div class="text-white p-1">مالیات موضوع ماده 17</div>-->
<!--                <input type="text" class="p-2 rounded" name="Tax17" v-model="Tax17">-->
<!--            </div>-->

<!--            body start-->
            <div class=" flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                <div class="text-white p-1">شرح كالا/خدمت</div>
                <input type="text" class="p-2 rounded" name="Sstt" v-model="Sstt" placeholder="شرح كالا/خدمت">
            </div>
            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                <div class="text-white p-1">شناسه كالا/خدمت</div>
                <input type="text" class="p-2 rounded" name="Sstid" v-model="Sstid" placeholder="شناسه كالا/خدمت">
            </div>

            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                <div class="text-white p-1"> تعداد/مقدار</div>
                <input type="text" class="p-2 rounded" name="Am" v-model="Am" placeholder=" تعداد/مقدار">
            </div>

            <div class=" flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                <div class="text-white p-1">واحد اندازه گیری</div>
                <input type="text" class="p-2 rounded" name="Mu" v-model="Mu" placeholder="واحد اندازه گیری">
            </div>

            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                <div class="text-white p-1">مبلغ واحد</div>
                <input type="text" class="p-2 rounded" name="Fee" v-model="Fee" placeholder="مبلغ واحد">
            </div>

            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                <div class="text-white p-1"> مبلغ تخفیف</div>
                <input type="text" class="p-2 rounded" name="Dis" v-model="Dis" placeholder=" مبلغ تخفیف">
            </div>

            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                <div class="text-white p-1">نرخ مالیات بر
                    ارزشافزوده
                </div>
                <input type="text" class="p-2 rounded" name="Vra" v-model="Vra" placeholder="نرخ مالیات بر
ارزشافزوده">
            </div>
        </div>
    </form>

</template>
