<template>
  <modal name="restore" :width="400" :height="200">
      <div class="flex flex-col justify-between p-8 h-full">
        <div class="text-center text-xl text-grey-darker">آیا مایل به بازگردانی
        <span v-text="data.title" v-if="data.title" class="text-red font-bold"></span>
         هستید؟</div>
        <div class="flex justify-between items-end h-full">
            <button type="button" class="rhc-btn rhc-btn-red" @click="restoreRecord">بازگردانی کن</button>
            <button type="button" class="rhc-btn" @click="$modal.hide('restore')">انصراف</button>
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
        console.log('Restore created ...');
        window.events.$on('restoreModal', data => this.showDialog(data));
    },

    methods :{
      showDialog (data){
        this.$modal.show('restore')
        this.data = data.data
      },

      restoreRecord (){
        axios.get(this.data.endpoint)
        .then(function (response){
          this.restore(response.data);
        }.bind(this))
        .catch(function(error){
          flash('خطا در بازگردانی', 'error')
        });
      },

      restore (data) {
        if (data.result == true) {
          flash('با موفقیت بازگردانی شد.')
        }else{
          flash('امکان بازگردانی وجود ندارد.', 'error')
        }
        this.$events.fire('item-delete')
        this.$modal.hide('restore')
      }
  }

}
</script>
