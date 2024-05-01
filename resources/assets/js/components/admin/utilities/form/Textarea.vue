<template>
    <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/4">
            <label class="block text-grey-dark md:text-right mb-1 md:mb-0 pr-4" :for="name">
                {{ title }} :
            </label>
            <div v-if="form.errors.has(name)" class="invisible">.</div>
        </div>


        <div class="md:w-2/3">

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
                rows="10"
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
                ></editor>
            </div>
            <div class="text-left text-xs mt-1" v-if="form_data[checkbox_name]">
                <span class="text-grey-dark">Fullscreen</span>
                <span class="text-grey">Ctrl+Shift+F</span>
            </div>

            <div class="text-sm -mt-2" v-if="help" v-text="help"></div>
            <div class="text-pink" v-if="form.errors.has(name)" v-text="form.errors.get(name)"></div>
        </div>


    </div>
</template>

<script>
export default {
    props: ['form', 'form_data', 'name', 'title', 'value', 'is_disabled', 'advance_editor', 'help'],
    data() {
        const handleImageUpload = (blobInfo, success, failure) => new Promise((resolve, reject) => {
            const formData = new FormData()


            formData.append('image', blobInfo.blob(), blobInfo.filename())


            return axios.post('/editor-files-upload', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {


                    success(response.data.location);
                    resolve(response.data.location);

                    return response.data.location
                })
        });
        return {
            checkbox_name: this.name + '_editor_type',
            config: {
                menubar: 'file edit view insert format tools table tc help',
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',

                plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap tinycomments mentions quickbars linkchecker emoticons advtable export wordcount code fullscreentable',
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
                directionality: 'rtl',
                language: 'fa',
                // language_url: '/js/editor/tinymce/fa/langs/fa.js',
                content_css: '/css/app-site.css',


                images_upload_url: '/editor-files-upload',
                automatic_uploads: true,
                images_reuse_filename: false,
                convert_urls: false,

                file_picker_types: 'image',

                relative_urls: true,
                document_base_url: window.location.origin + '/',

                images_upload_handler: handleImageUpload,

                deprecation_warnings: false
            }
        }
    },
    created() {
        // this.form_data[this.name] = this.value
        this.$set(this.form_data, this.name, this.value)
    }
}
</script>
