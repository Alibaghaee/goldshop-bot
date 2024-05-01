<template>
    <div>
        <div class="mb-4 p-2 text-xl">یادداشت های من</div>
        <div class="leading-loose">
            <div class="flex flex-wrap justify-between items-center bg-grey-lightest my-1 rounded p-2" v-for="task in items" :class="{ 'bg-teal text-white' : task.complete }" v-if="task.visible">
                <div v-text="task.title"></div>
                <div class="flex flex-wrap w-full mt-2 justify-between" v-show="task.visible">
                    <svg v-if="!task.complete" @click="task.complete = ! task.complete" class="fill-current cursor-pointer w-6 h-6 text-grey-light" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 416 416"><path d="M208 0C93.601 0 0 93.601 0 208s93.601 208 208 208 208-93.601 208-208S322.399 0 208 0zm0 374.399c-91.518 0-166.399-74.882-166.399-166.399S116.482 41.6 208 41.6 374.4 116.482 374.4 208 299.518 374.399 208 374.399z"/></svg>
                    <svg v-if="task.complete" @click="task.complete = ! task.complete" class="fill-current cursor-pointer w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 416 416"><path d="M208 104c-57.2 0-104 46.8-104 104s46.8 104 104 104 104-46.8 104-104-46.8-104-104-104zm0-104C93.601 0 0 93.601 0 208s93.601 208 208 208 208-93.601 208-208S322.399 0 208 0zm0 374.4c-91.518 0-166.4-74.883-166.4-166.4S116.482 41.6 208 41.6 374.4 116.482 374.4 208 299.518 374.4 208 374.4z"/></svg>

                    <svg @click="deleteItem(task)" class="fill-current cursor-pointer w-6 h-6" 
                    :class="[ task.complete ? 'text-white' : 'text-grey-light']"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1100 1300"><path d="M400 0h300q41 0 70.5 29.5T800 100v100h275q10 0 17.5 7.5t7.5 17.5v75H0v-75q0-10 7.5-17.5T25 200h275V100q0-41 29.5-70.5T400 0zm0 100v100h300V100H400zm600 300v800q0 41-29.5 70.5T900 1300H200q-41 0-70.5-29.5T100 1200V400h900zM200 500v700h100V500H200zm200 0v700h100V500H400zm200 0v700h100V500H600zm200 0v700h100V500H800z"/></svg>
                </div>

            </div>
        </div>
        <div class="flex my-2 -mx-1 text-white text-sm">
            <div class="flex md:flex-col justify-between flex-1 rahco-center cursor-pointer px-1 mx-1 rhc-btn h-16" @click="filter('all')">
                <div>همه</div>
                <div v-text="items.length"></div>
            </div>
            <div class="flex md:flex-col justify-between flex-1 rahco-center cursor-pointer px-1 mx-1 rhc-btn rhc-btn-pink h-16"  @click="filter('incomplete')">
                <div>انجام نشده</div>
                <div v-text="completeTasks"></div>
            </div>
            <div class="flex md:flex-col justify-between flex-1 rahco-center cursor-pointer px-1 mx-1 rhc-btn rhc-btn-teal h-16"  @click="filter('complete')">
                <div>انجام شده</div>
                <div v-text="incompleteTasks"></div>
            </div>
        </div>
        <textarea name="" id="description" cols="30" rows="3" v-model="new_task" @keydown.enter.ctrl.exact="newLine()" @keydown.enter.exact.prevent="addItem()" value="" placeholder="یادداشت جدید" class="rahco-text-input bg-white mb-1 py-4"></textarea>

        <button type="submit" class="w-full rhc-btn" :class="{ 'rhc-btn-disabled' : !new_task.length }" :disabled="!new_task.length" @click.prevent="addItem()">ثبت</button>
    </div>
</template>

<script>
    export default {
        props: ['tasks'],
 
        data () {
            return {
                items: [
                    {
                        'id': 15,
                        'title': 'یادداشت شماره یک. یادداشت شماره یک. یادداشت شماره یک. یادداشت شماره یک. یادداشت شماره یک. یادداشت شماره یک.',
                        'complete': false,
                        'visible': true
                    },
                    {
                        'id': 16,
                        'title': 'یادداشت شماره دو.',
                        'complete': true,
                        'visible': true
                    },
                    {
                        'id': 17,
                        'title': 'یادداشت شماره سه.',
                        'complete': false,
                        'visible': true
                    },
                    {
                        'id': 18,
                        'title': 'یادداشت شماره چهار.',
                        'complete': false,
                        'visible': true
                    }
                ],
                new_task : ''
            }

        },

        methods: {
            addItem () {
                if (this.new_task) {
                    let task = {
                        id: Date.now(),
                        title: this.new_task,
                        complete: false,
                        visible: true
                    }
                    this.items.push(task)
                    this.new_task = ''
                }
            },

            deleteItem (removedTask) {
                let new_task_list = this.items.filter(function(task){
                    return task.id != removedTask.id
                })
                this.items = new_task_list
            },

            newLine (){
                $('#description').val($('#description').val() + "\n");
            },

            filter (status = null) {
                if (status == 'all') {
                    this.items.forEach(item => {
                        item.visible = true;
                    })
                }else if (status == 'complete'){
                    this.items.forEach(item => {
                        if (item.complete) { item.visible = true; }
                        if (!item.complete) { item.visible = false; }
                    })
                }else if (status == 'incomplete'){
                    this.items.forEach(item => {
                        if (!item.complete) { item.visible = true; }
                        if (item.complete) { item.visible = false; }
                    })
                }
            }
        },

        computed: {
            completeTasks () {
                return this.items.filter(task => {
                    return !task.complete
                }).length
            },
            incompleteTasks () {
                return this.items.filter(task => {
                    return task.complete
                }).length
            },
        }
    }
</script>