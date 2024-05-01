<div class="md:flex md:items-center mb-6">
    <div class="md:w-1/4">
      <label class="block text-grey-dark md:text-right mb-1 md:mb-0 pr-4" for="title">
        عنوان :
      </label>
      <div v-if="form.errors.has('title')" class="invisible">.</div>
    </div>
    <div class="md:w-2/3">
      <input type="text" name="title" id="title" class="rhc-form-control" placeholder="عنوان" v-model="form_data.title">
      <div class="text-pink" v-if="form.errors.has('title')" v-text="form.errors.get('title')"></div>
    </div>
</div>