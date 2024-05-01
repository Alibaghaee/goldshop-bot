<template>
    <div class="relative md:flex flex-wrap md:mx-3 md:mb-8">

        <div @click="scrollEvent('left')" style="background-color: #488ae1;" class="absolute sm:hidden md:block left-arrow rounded-full
          h-10 w-10   border border-black hover:border-grey-lighter">

            <img class="p-2 " src="image/site/icons/svg/arrow-left.svg" alt="">
        </div>

        <div @click="scrollEvent('right')" style="background-color: #488ae1;" class="absolute sm:hidden md:block right-arrow rounded-full   bg-blue-dark
          h-10 w-10  border border-black hover:border-grey-lighter">

            <img class="p-2" src="image/site/icons/svg/arrow-right.svg" alt="">
        </div>
        <div
            ref="widgetsContent"
            class="featureTabs  flex gap-4 justify-center scroll-snap-x overflow-auto pb-4 px-4 mx-12">

            <div class="min-w-[200px] flex flex-col rounded-md overflow-hidden bg-white "
                 style="min-width: 200px;"

                 v-for=" item  in items">
                <img class=" w-fit" :src="item.image" :alt="item.title" style="width: 100%;height: 10rem;" />
                <div class="p-5">
                    <h5 class="border-b mt-2 pb-2 text-black font-bold text-sm">
                        {{ item.title }}
                    </h5>
                    <div class="flex justify-between mt-4 text-sm">
                        <span  style="color: #007aff;">{{ item.created_at_fa }}</span>
                        <span @click="getLink(item.id)"
                              class=" cursor-pointer" style="color: #007aff;">بیشتر بخوانید</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {

    props: ['items'],

    data() {

        return {
            active_tab: 1,
            play: false
        }
    },

    methods: {
        getLink(id) {

            window.location.href = '/fa/news/' + id;
        },
        setActiveTab(id) {
            this.active_tab = id
        },
        isActiveTab(id) {
            return this.active_tab == id
        },
        scrollEvent(data) {
            if (data == 'left') {

                this.$refs['widgetsContent'].scrollTo({
                    left: (this.$refs['widgetsContent'].scrollLeft - 250),
                    behavior: 'smooth'
                });

            } else {

                this.$refs['widgetsContent'].scrollTo({
                    left: (this.$refs['widgetsContent'].scrollLeft + 250),
                    behavior: 'smooth'
                });
            }
        },
        sleep(milliseconds) {
            return new Promise((resolve) => setTimeout(resolve, milliseconds));
        },
        async playQuote() {
            let counter = this.items.length + this.items.length;
            for (let i = 0; i < counter; i++) {
                await this.sleep(1000);

                this.$refs['widgetsContent'].scrollTo({
                    left: (this.$refs['widgetsContent'].scrollLeft - 50),
                    behavior: 'smooth'
                });
                if (i === counter - 1) {
                    this.$refs['widgetsContent'].scrollTo({
                        left: (this.$refs['widgetsContent'].scrollLeft + 1000),
                        behavior: 'smooth'
                    });
                    i = -1
                }
            }
        },
        onScroll(e) {
            this.windowTop = window.top.scrollY


            // if (window.top.scrollY >= 960) {
            //
            //     if (!this.play) {
            //
            //
            //         this.playQuote()
            //     }
            //     this.play = true;
            // }
        }
    },
    beforeDestroy() {
        window.removeEventListener("scroll", this.onScroll)
    },
    mounted() {

        window.addEventListener("scroll", this.onScroll)


    }
}
</script>
