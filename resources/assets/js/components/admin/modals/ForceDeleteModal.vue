<template>
  <modal name="forcedelete" :width="400" :height="200">
      <div class="flex flex-col justify-between p-8 h-full">
        <div class="text-center text-xl text-grey-darker">آیا مایل به حذف کامل
        <span v-text="data.title" v-if="data.title" class="text-red font-bold"></span>
         هستید؟</div>
        <div class="flex justify-between items-end h-full">
            <button type="button" class="rhc-btn rhc-btn-red" @click="forcedeleteRecord">حذف کامل شود</button>
            <button type="button" class="rhc-btn" @click="$modal.hide('forcedelete')">انصراف</button>
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
        console.log('ForceDelete created ...');
        window.events.$on('forcedeleteModal', data => this.showDialog(data));
    },

    methods :{
      showDialog (data){
        this.$modal.show('forcedelete')
        this.data = data.data
      },

      forcedeleteRecord (){
        axios.delete(this.data.endpoint)
        .then(function (response){
          this.forcedelete(response.data);
        }.bind(this))
        .catch(function(error){
          flash('خطا در حذف کامل', 'error')
        });
      },

      forcedelete(data) {
        if (data.result == true) {
          flash('با موفقیت حذف کامل شد.')
        }else{
          flash('امکان حذف کامل وجود ندارد.', 'error')
        }
        this.$events.fire('item-delete')
        this.$modal.hide('forcedelete')
      }
  }

}
</script>
