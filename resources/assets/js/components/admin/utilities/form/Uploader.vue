<template>
    <div class="mb-6">
        <!--UPLOAD-->
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/4">
                <label class="block text-grey-dark md:text-right mb-1 md:mb-0 pr-4" :for="name">
                    {{ title }} :
                </label>
            </div>
            <div class="md:w-2/3">
                <div v-if="isSaving">
                    <div class="w-full text-center">{{ uploadPercentage }}%</div>
                    <div class="flex mb-2 rounded h-10 items-center bg-grey-lighter">
                        <div class="bg-green w-full h-10 mr-auto rounded" id="progress-bar"
                             :style="'width: ' + uploadPercentage + '%'"></div>
                    </div>
                </div>
                <form enctype="multipart/form-data" novalidate v-if="isInitial || isSaving">
                    <div class="dropbox">
                        <!-- removed multiple attribute -->
                        <input type="file" :name="name" :disabled="isSaving"
                               @change="filesChange($event.target.name, $event.target.files); fileCount = $event.target.files.length"
                               accept="image/*,.zip,.7zip,.doc,.docx,.xls,.xlsx,.pdf,.zip,.7z,.mp4" class="input-file"
                               :id="name">
                        <p v-if="isInitial">
                            برای شروع بارگزاری فایل(ها) را بر روی این قسمت بکشید.<br> یا برای انتخاب کلیک کنید.
                        </p>
                        <p v-if="isSaving">
                            بارگزاری {{ fileCount }} فایل...
                        </p>
                    </div>
                </form>
                <!--SUCCESS-->
                <div v-if="isSuccess" class="flex flex-col bg-grey-lighter rounded p-2">
                    <div class="flex flex-wrap justify-between items-center mb-2">
                        <div class="mb-2 text-white text-bold bg-green p-1 px-4 rounded">
                            {{ uploadedFiles.length }} فایل با موفقیت بارگزاری شد.
                        </div>
                        <button type="button" class="mb-2 rhc-btn rhc-btn-indigo flex items-center" @click="reset()">
                            <div>بارگزاری دوباره</div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 fill-current mr-2" viewBox="0 0 512 512">
                                <path
                                    d="M256 388c-72.597 0-132-59.405-132-132 0-72.601 59.403-132 132-132 36.3 0 69.299 15.4 92.406 39.601L278 234h154V80l-51.698 51.702C348.406 99.798 304.406 80 256 80c-96.797 0-176 79.203-176 176s78.094 176 176 176c81.045 0 148.287-54.134 169.401-128H378.85c-18.745 49.561-67.138 84-122.85 84z"/>
                            </svg>
                        </button>

                        <button type="button" class="mb-2 rhc-btn rhc-btn-indigo flex items-center"
                                @click="destroyFile()">
                            <div>حذف فایل</div>
                            <svg style="color: red" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                 fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"
                                    fill="red"></path>
                                <path fill-rule="evenodd"
                                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"
                                      fill="red"></path>
                            </svg>

                        </button>
                    </div>
                    <ul class="list-reset">
                        <li v-for="item in uploadedFiles">
                            <img :src="item.url" class="mx-auto block" :alt="item.originalName"
                                 v-if="['.jpeg', '.jpg', '.png'].includes(item.extension)">
                            <a :href="item.url" v-else
                               class="block text-center py-4 text-2xl bg-grey-lightest shadow m-1 hover:bg-white"
                               target="_blank"><strong class="inline-block ltr">فایل{{ item.extension }}</strong></a>
                        </li>
                    </ul>
                </div>
                <!--FAILED-->
                <div v-if="isFailed" class="flex justify-between">
                    <strong class="text-pink">بارگزاری ناموفق بود.</strong>
                    <a href="javascript:void(0)" @click="reset()">تلاش مجدد</a>
                </div>
                <div class="text-pink">{{ uploadError }}</div>
                <div class="text-pink" v-if="form.errors.has(name)" v-text="form.errors.get(name)"></div>

                <div v-if="isSuccess" class="py-2 px-4 mb-6 bg-grey-lightest rounded">
                    لینک فایل:
                    <a :href="fileUrl" v-text="form_data[name]" target="_blank"
                       class="block break-words font-bold hover:text-blue-dark ltr no-underline text-grey-darkest text-left"></a>
                </div>
            </div>

        </div>
    </div>

</template>

<script>
const STATUS_INITIAL = 0, STATUS_SAVING = 1, STATUS_SUCCESS = 2, STATUS_FAILED = 3;

export default {
    props: ['form', 'form_data', 'name', 'title', 'action', 'method', 'value'],
    data() {
        return {
            uploadedFiles: [],
            uploadError: null,
            currentStatus: STATUS_INITIAL,
            requestMethod: 'post',
            uploadPercentage: 0,
        }
    },
    computed: {
        isInitial() {
            return this.currentStatus === STATUS_INITIAL;
        },
        isSaving() {
            return this.currentStatus === STATUS_SAVING;
        },
        isSuccess() {
            return this.currentStatus === STATUS_SUCCESS;
        },
        isFailed() {
            return this.currentStatus === STATUS_FAILED;
        },
        fileUrl() {
            return window.location.protocol + '//' + window.location.hostname + this.form_data[this.name];
        }
    },
    watch: {
        uploadedFiles() {
            if (typeof (this.uploadedFiles[0]) !== 'undefined') {
                this.form_data[this.name] = this.uploadedFiles[0]['path'];
            }
        }
    },
    methods: {
        reset() {
            // reset form to initial state
            this.currentStatus = STATUS_INITIAL;
            this.uploadedFiles = [];
            this.uploadError = null;
            this.$set(this.form_data, this.name, null)
        },
        destroyFile() {

            if (this.value !== null) {
                var formData = {'file': this.value};

                var url = '/delete-locale-files';

                axios.post(url, formData, {}).then(x => {})

            }
            // reset form to initial state
            this.currentStatus = STATUS_INITIAL;
            this.uploadedFiles = [];
            this.uploadError = null;
            this.$set(this.form_data, this.name, null)
            this.value = '';
        },
        save(formData) {
            // upload data to the server
            this.currentStatus = STATUS_SAVING;

            // upload method adapter
            formData = this.uploadMethodApdapter(formData);

            this.upload(formData)
                .then(this.wait(1500)) // DEV ONLY: wait for 1.5s
                .then(x => {
                    this.uploadedFiles = [].concat(x);
                    this.currentStatus = STATUS_SUCCESS;
                })
                .catch(err => {
                    this.uploadError = err.response.data.errors[this.name][0];
                    this.currentStatus = STATUS_FAILED;
                });
        },
        filesChange(fieldName, fileList) {
            // handle file changes
            const formData = new FormData();

            if (!fileList.length) return;

            // append the files to FormData
            Array
                .from(Array(fileList.length).keys())
                .map(x => {
                    formData.append(fieldName, fileList[x], fileList[x].name);
                });

            // save it
            this.save(formData);
        },
        upload(formData) {
            const url = this.action;
            return axios.post(url, formData, {
                onUploadProgress: function (progressEvent) {
                    this.uploadPercentage = parseInt(Math.round((progressEvent.loaded / progressEvent.total) * 100));
                }.bind(this)
            })
                // get data
                .then(x => x.data)
                // add url field
                .then(x => x.map(img => Object.assign({}, img, {
                    url: `${img.path}`,
                    extension: img.path.match(/\.([0-9a-z]+)(?=[?#])|(\.)(?:[\w]+)$/gmi)[0]
                })));
        },
        wait(ms) {
            return (x) => {
                return new Promise(resolve => setTimeout(() => resolve(x), ms));
            };
        },
        editState() {
            // if the current form is edit form and uploader control has value set the image
            if (this.value && this.value.length) {
                this.uploadedFiles = [{
                    'url': this.value,
                    'path': this.value,
                    'extension': this.value.match(/\.([0-9a-z]+)(?=[?#])|(\.)(?:[\w]+)$/gmi)[0]
                }]
                this.initialDefaultPath()
                this.currentStatus = 2
            }
        },
        initialDefaultPath() {
            // this.form_data[this.name] = this.value
            this.$set(this.form_data, this.name, this.value)
        },
        setRequestMethod() {
            if (this.method) {
                this.requestMethod = this.method
            }
        },
        uploadMethodApdapter(formData) {
            if (this.requestMethod == 'post') {
                return formData;
            }
            if (this.requestMethod == 'put') {
                formData.append('_method', 'PATCH');
                return formData;
            }
        }
    },
    mounted() {
        // this.reset();
        this.editState();
        this.setRequestMethod();
    }
}

</script>

<style lang="scss">
.dropbox {
    outline: 2px dashed #afafaf; /* the dash box */
    outline-offset: -10px;
    background: #f1f5f8;
    color: #8795a1;
    padding: 10px 10px;
    min-height: 200px; /* minimum height */
    position: relative;
    cursor: pointer;
}

.input-file {
    opacity: 0; /* invisible but it's there! */
    width: 100%;
    height: 200px;
    position: absolute;
    cursor: pointer;
}

.dropbox:hover {
    background: #dae1e7; /* when mouse over to the drop zone, change color */
}

.dropbox p {
    font-size: 1em;
    text-align: center;
    padding: 50px 0;
}

#progress-bar {
    transition: width .3s ease;
}
</style>
