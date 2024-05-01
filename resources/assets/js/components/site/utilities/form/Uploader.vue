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
          <form enctype="multipart/form-data" novalidate v-if="isInitial || isSaving">
              <div class="dropbox">
              <!-- removed multiple attribute -->
              <input type="file" :name="name" :disabled="isSaving" @change="filesChange($event.target.name, $event.target.files); fileCount = $event.target.files.length"
                accept="image/*,.zip,.7zip,.doc,.docx,.xls,.xlsx,.pdf,.zip,.7z" class="input-file" :id="name">
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
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 fill-current mr-2" viewBox="0 0 512 512"><path d="M256 388c-72.597 0-132-59.405-132-132 0-72.601 59.403-132 132-132 36.3 0 69.299 15.4 92.406 39.601L278 234h154V80l-51.698 51.702C348.406 99.798 304.406 80 256 80c-96.797 0-176 79.203-176 176s78.094 176 176 176c81.045 0 148.287-54.134 169.401-128H378.85c-18.745 49.561-67.138 84-122.85 84z"/></svg>
              </button>
            </div>
            <ul class="list-reset">
              <li v-for="item in uploadedFiles">
                <img :src="item.url" class="mx-auto block" :alt="item.originalName" v-if="['.jpeg', '.jpg', '.png'].includes(item.extension)">
                <a :href="item.url" v-else class="block text-center py-4 text-2xl bg-grey-lightest shadow m-1 hover:bg-white" target="_blank"><strong class="inline-block ltr">فایل{{ item.extension }}</strong></a>
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
      }
    },
    watch: {
      uploadedFiles() {
        if (typeof(this.uploadedFiles[0]) !== 'undefined') {
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
          return axios.post(url, formData)
              // get data
              .then(x => x.data)
              // add url field
              .then(x => x.map(img => Object.assign({}, img, { url: `${img.path}`, extension: img.path.match(/\.([0-9a-z]+)(?=[?#])|(\.)(?:[\w]+)$/gmi)[0] })));
      },
      wait(ms) {
          return (x) => {
              return new Promise(resolve => setTimeout(() => resolve(x), ms));
          };
      },
      editState(){
        // if the current form is edit form and uploader control has value set the image
        if (this.value && this.value.length) {
          this.uploadedFiles = [{'url' : this.value, 'path' : this.value, 'extension': this.value.match(/\.([0-9a-z]+)(?=[?#])|(\.)(?:[\w]+)$/gmi)[0]}]
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
      uploadMethodApdapter(formData){
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
</style>