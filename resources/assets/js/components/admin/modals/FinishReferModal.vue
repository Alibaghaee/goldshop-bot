<template>
  <modal name="finish-refer" :width="400" :height="200">
      <div class="flex flex-col justify-between p-8 h-full">
        <div class="text-center text-xl text-grey-darker">آیا مایل به پایان ارجاع
        <span v-text="data.title" v-if="data.title" class="text-red font-bold"></span>
         هستید؟</div>
        <div class="flex justify-between items-end h-full">
            <button type="button" class="rhc-btn rhc-btn-red" @click="finishRefer">تایید</button>
            <button type="button" class="rhc-btn" @click="$modal.hide('finish-refer')">انصراف</button>
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
        console.log('finishReferModal created ...');
        window.events.$on('finishReferModal', data => this.showDialog(data));
    },

    methods :{
      showDialog (data){
        this.$modal.show('finish-refer')
        this.data = data.data
      },
      
      finishRefer (){
        axios.get(this.data.endpoint)
        .then(function (response){
          console.log(response.data);
          this.finish(response.data);
        }.bind(this))
        .catch(function(error){
          flash('خطا در در انجام عملیات', 'error')
        });
      }, 

      finish (data) {
        if (data.result == true) {
          flash('عملیات با موفقیت انجام شد.')
        }else{
          flash('امکان انجام عملیات وجود ندارد.', 'error')
        }
        this.$events.fire('item-delete')
        this.$modal.hide('finish-refer')
      }
  }
  
}
</script>