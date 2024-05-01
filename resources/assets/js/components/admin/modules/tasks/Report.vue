<template>
  <div class="flex bg-grey-lighter mt-16 p-4 px-4 rounded w-full font-bold">
    <div class="w-full md:w-1/4 text-center">
      <label>تعداد کل: </label>
      <span>{{data.total}}</span>
    </div>
    <div class="w-full md:w-1/4 text-center text-green">
      <label>انجام شده: </label>
      <span>{{data.task_status_complete}}</span>
    </div>
    <div class="w-full md:w-1/4 text-center text-teal">
      <label>در حال انجام: </label>
      <span>{{data.task_status_pending}}</span>
    </div>
    <div class="w-full md:w-1/4 text-center text-pink">
      <label>انجام نشده: </label>
      <span>{{data.task_status_incomplete}}</span>
    </div>
    <div class="w-full md:w-1/4 text-center">
      <label>بدون وضعیت: </label>
      <span>{{data.task_status_null}}</span>
    </div>
  </div>
</template>

<script>

export default {
  data (){
    return {
        data : {},
        form_data : {},
        endpoint : '/tasks/tasks/report'
    }
  },

  created(){
    this.setData();
  },

   mounted () {
      window.events.$on('filter-set-for-report', eventData => this.onFilterSet(eventData))
      window.events.$on('filter-reset-for-report', e => this.onFilterReset())
  },

  methods: {
    setData () {
      axios.post(this.endpoint, this.form_data)
      .then(function (response){
        this.data = response.data;
      }.bind(this))
    },

    onFilterSet(data) {
      this.form_data = data;
      this.setData();
    },

    onFilterReset(){
      this.form_data = {};
    }


  },
}
</script>
