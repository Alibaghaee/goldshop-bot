<template>
      <div>
          <div class="flex flex-wrap items-center -mx-2">

            <div class="flex flex-wrap w-full">

              <slot name="controls" :form_errors="formErrors" :form_data="formData">
                  <!-- default input if not replace with something else -->
                  <i-text-filter :form_errors="formErrors" :form_data="formData" name="name" title="عنوان"></i-text-filter>
              </slot>

            </div>
          </div>

          <div class="flex w-full justify-between my-4">
              <div>
                <button class="flex items-center rhc-btn rhc-btn-green" @click="exportExcel" v-if="excel_export_endpoint">
                  دریافت اکسل
                  <svg class="w-6 h-6 mr-3 fill-current" height="512px" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="comp_x5F_119-excel"><g><path d="M476.624,97.457H289.746v57.656h43.131c7.934,0,14.371,6.458,14.371,14.413c0.001,7.957-6.438,14.415-14.371,14.415    h-43.131v28.831h43.131c7.934,0,14.371,6.458,14.371,14.408c0.001,7.96-6.438,14.417-14.371,14.417h-43.131v28.828h43.131    c7.934,0,14.371,6.457,14.371,14.415c0.001,7.951-6.438,14.409-14.371,14.409h-43.131v28.832h43.131    c7.934,0,14.371,6.458,14.371,14.417c0,7.956-6.438,14.412-14.371,14.412h-43.131v57.653h186.878    c7.938,0,14.376-6.455,14.375-14.416V111.87C490.999,103.913,484.562,97.457,476.624,97.457z M419.125,356.909h-28.75    c-7.934,0-14.377-6.456-14.377-14.412c0-7.959,6.443-14.417,14.377-14.417h28.75c7.933,0,14.373,6.458,14.373,14.417    C433.498,350.453,427.058,356.909,419.125,356.909z M419.125,299.248h-28.75c-7.934,0-14.377-6.458-14.377-14.409    c0-7.958,6.443-14.415,14.377-14.415h28.75c7.933,0,14.373,6.457,14.373,14.415C433.498,292.79,427.058,299.248,419.125,299.248z     M419.125,241.596h-28.75c-7.934,0-14.377-6.457-14.377-14.417c0-7.95,6.443-14.408,14.377-14.408h28.75    c7.933,0,14.373,6.458,14.373,14.408C433.498,235.139,427.058,241.596,419.125,241.596z M419.125,183.939h-28.75    c-7.934,0-14.377-6.458-14.377-14.415c0-7.955,6.443-14.413,14.377-14.413h28.75c7.933,0,14.373,6.458,14.373,14.413    C433.498,177.482,427.058,183.939,419.125,183.939z"/><path d="M274.548,43.115c-3.282-2.738-7.681-3.922-11.819-3.053L32.731,83.3c-6.814,1.275-11.73,7.211-11.73,14.157v317.106    c0,6.919,4.916,12.883,11.73,14.157l229.997,43.24c0.862,0.17,1.754,0.259,2.646,0.259c3.334,0,6.582-1.152,9.172-3.318    c3.309-2.734,5.199-6.828,5.199-11.099v-43.239v-57.653V328.08v-28.832v-28.824v-28.828v-28.826v-28.831v-28.827V97.457V54.219    C279.745,49.921,277.854,45.855,274.548,43.115z M217.338,324.504c-2.732,2.395-6.1,3.578-9.466,3.578    c-3.992,0-7.96-1.675-10.809-4.954l-41.799-47.891l-36.659,47.277c-2.843,3.665-7.071,5.565-11.354,5.565    c-3.073,0-6.21-0.98-8.857-3.025c-6.236-4.898-7.388-13.953-2.499-20.241l40.078-51.657l-39.532-45.317    c-5.232-5.97-4.627-15.078,1.351-20.32c5.923-5.25,15.01-4.703,20.269,1.357l35.88,41.102l42.583-54.889    c4.909-6.253,13.938-7.407,20.176-2.504c6.238,4.896,7.395,13.95,2.507,20.238l-45.978,59.271l45.46,52.088    C223.918,310.152,223.316,319.262,217.338,324.504z"/></g></g><g id="Layer_1"/></svg>
                </button>
              </div>
              <div>
                <button class="rhc-btn rhc-btn-blue mr-2" @click="doFilter">تایید</button>
                <button class="rhc-btn rhc-btn-pink mr-2" @click="resetFilter">بازنشانی</button>
              </div>
          </div>
      </div>
</template>

<script>

/**
 * Handle form submission.
 */
import Errors from './../../../../error';

export default {

  props: ['errors', 'excel_export_endpoint'],
  data () {
    return {
      formErrors: new Errors,
      formData: {}
    }
  },
  methods: {
    doFilter () {
      this.$events.fire('filter-set', this.formData)
      window.events.$emit('filter-set-for-report', this.form_data)
    },
    resetFilter () {
      this.formData = {}
      this.doFilter()
      window.events.$emit('filter-reset-for-report', this.form_data)
    },
    exportExcel () {
      let data = this.formData;

      var form_data = new FormData();

      for ( var key in data ) {
        if (data[key]) {
          let value = typeof(data[key]) == 'object' ? JSON.stringify(data[key]) : data[key];
          form_data.append(key, value);
        }
      }

      const queryString = new URLSearchParams(form_data).toString();
      window.location.href = this.excel_export_endpoint + '?' + queryString;

      // axios.post(this.excel_export_endpoint, form_data)
      // .then(function (response){
      //   flash('دریافت خروجی اکسل با موفقیت انجام شد.', 'success')
      // }.bind(this))
      // .catch(function(error){
      //   flash('خطا در در دریافت خروجی اکسل', 'error')
      // });
    }
  },
  watch: {
    errors(val) { 
      this.formErrors.record(val)
    }
  }
}
</script>