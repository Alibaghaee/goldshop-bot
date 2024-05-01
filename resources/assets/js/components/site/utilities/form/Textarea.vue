<template>
    <div class="md:flex md:items-center mb-4 w-full flex-wrap">
        <!-- <div class="md:w-1/4">
          <label class="block text-grey-dark md:text-right mb-1 md:mb-0 pr-4" :for="name">
            {{ title }} :
          </label>
          <div v-if="form.errors.has(name)" class="invisible">.</div>
        </div> -->

        
        <div class="w-full flex">

          <i-editor-checkbox 
              v-if="advance_editor"
              :form="form" 
              :form_data="form_data" 
              :name="checkbox_name" 
              title="حالت پیشرفته"
          ></i-editor-checkbox>

          <textarea
            v-if="!form_data[checkbox_name]"
            :name="name" 
            :id="name" 
            cols="30" 
            rows="4" 
            class="rhc-form-control" 
            :placeholder="title" 
            v-model="form_data[name]" 
            v-text="form_data[name]"
            :disabled="is_disabled"
          ></textarea>
          
          <div class="bg-grey-lighter p-1 rounded" v-if="form_data[checkbox_name]">
            <editor
            :name="name" 
            :id="name" 
            cols="30"
            rows="20" 
            class="rhc-form-control" 
            :placeholder="title" 
            v-model="form_data[name]" 
            v-text="form_data[name]"
            :disabled="is_disabled"
            :init="config"
            :toolbar="toolbar"
            ></editor>
          </div>
          <div class="text-left text-xs mt-1" v-if="form_data[checkbox_name]">
            <span class="text-grey-dark">Fullscreen</span>
            <span class="text-grey">Ctrl+Shift+F</span>
          </div>

        </div>

        <div class="w-full">
          <div class="text-sm -mt-2" v-if="help" v-text="help"></div>
          <div class="text-pink" v-if="form.errors.has(name)" v-text="form.errors.get(name)"></div>
        </div>
        
      </div>
    </div>
</template>

<script>
    export default {
        props: ['form', 'form_data', 'name', 'title', 'value', 'is_disabled', 'advance_editor', 'help'],
        data (){
          return {
            checkbox_name: this.name + '_editor_type',
            toolbar: "undo redo | styleselect | bold italic | bullist numlist outdent indent | alignleft aligncenter alignright alignjustify | fontsizeselect | forecolor | backcolor",
            config: {
              plugins: ['wordcount', 'code', 'fullscreen','table', 'anchor', 'preview', 'print', 'template', 'image'],
              templates: [
                {title: 'Some title 1', description: 'Some desc 1', content: 'My content'},
                {title: 'Some title 2', description: 'Some desc 2', url: 'development.html'}
              ],
              image_list: [
                  {title: 'My image 1', value: 'https://www.tinymce.com/my1.gif'},
                  {title: 'My image 2', value: 'http://www.moxiecode.com/my2.gif'}
                ],
              branding: false,
              height: 600,
              // directionality : 'rtl',
              // language: 'fa_IR',
              language_url : '/js/editor/langs/fa_IR.js',
              content_css : '/css/app-site.css',
            }
          }
        },
        created(){
          // this.form_data[this.name] = this.value
          this.$set(this.form_data, this.name, this.value)
        }
    }
</script>