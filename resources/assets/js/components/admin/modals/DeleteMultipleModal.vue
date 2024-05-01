<template>
  <modal name="deleteMultiple" :width="400" :height="200">
      <div class="flex flex-col justify-between p-8 h-full">
        <div class="text-center text-xl text-grey-darker">{{ $t('Delete') }}:
        <span v-text="data.title" v-if="data.title" class="text-red font-bold"></span>
        </div>
        <div class="flex justify-between items-end h-full">
            <button type="button" class="rhc-btn rhc-btn-red" @click="deleteRecord">{{ $t('Delete') }}</button>
            <button type="button" class="rhc-btn" @click="$modal.hide('deleteMultiple')">{{ $t('Cancel') }}</button>
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
        console.log('DeleteMultipleModal created ...');
        window.events.$on('deleteMultipleModal', data => this.showDialog(data));
    },

    methods :{
      showDialog (data){
        this.$modal.show('deleteMultiple')
        this.data = data.data
      },

      deleteRecord (){
        axios.post(this.data.endpoint, {'ids':
                this.data.ids})
        .then(function (response){
          this.delete(response.data);
        }.bind(this))
        .catch(function(error){
          flash('Error', 'error')
        });
      },

      delete (data) {
        let message = '';

        if (data.result > 0) {
          message = data.message ? data.message : data.result + ' Items Deleted Successfully'
          flash(message)
        }else{
          message = data.message ? data.message : 'Operation Denied.'
          flash(message, 'error')
        }
        this.$events.fire('item-delete')
        this.$modal.hide('deleteMultiple')
      }
  }

}
</script>
