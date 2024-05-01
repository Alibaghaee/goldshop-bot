<template>
  <modal name="delete" :width="400" :height="200">
      <div class="flex flex-col justify-between p-8 h-full">
        <div class="text-center text-xl text-grey-darker">آیا مایل به حذف
        <span v-text="data.title" v-if="data.title" class="text-red font-bold"></span>
         هستید؟</div>
        <div class="flex justify-between items-end h-full">
            <button type="button" class="rhc-btn rhc-btn-red" @click="deleteRecord">حذف کن</button>
            <button type="button" class="rhc-btn" @click="$modal.hide('delete')">انصراف</button>
        </div>
      </div>
  </modal>
</template>

<script>
export default {
    data (){
        return {
            data: '',
        }
    },

    created (){
        console.log('DeleteModal created ...');
        window.events.$on('deleteModal', data => this.showDialog(data));
    },

    methods :{
      showDialog (data){
        this.$modal.show('delete')
        this.data = data.data
      },
      
      deleteRecord (){
        axios.delete(this.data.endpoint)
        .then(function (response){
          this.delete(response.data);
        }.bind(this))
        .catch(function(error){
          flash('خطا در حذف', 'error')
        });
      }, 

      delete (data) {
        if (data.result == true) {
          flash('با موفقیت حذف شد.')
        }else{
          flash('امکان حذف وجود ندارد.', 'error')
        }
        this.$events.fire('item-delete')
        this.$modal.hide('delete')
      }
  }
  
}
</script>