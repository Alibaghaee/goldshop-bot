<i-multiselect
    :form="form"
    :form_data="form_data"
    name="category_item_id"
    title="گروه *"
    :options="{{ $categories }}"
    group_label="name"
    group_values="items"

    @if($model->category_item_id)
    :value="{{ $category_items->where('id', $model->category_item_id)->first() }}"
    @endif

></i-multiselect>


<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="html_title"
    title="عنوان (title) *"
    value="{{ $model->html_title }}"
></i-text>


<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="title"
    title="عنوان (H1)"
    value="{{ $model->title }}"
></i-text>

{{--<i-text--}}
{{--    type="text"--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="title_en"--}}
{{--    title="عنوان انگلیسی (H1)"--}}
{{--    value="{{ $model->title_en }}"--}}
{{--></i-text>--}}

<i-textarea
    :advance_editor="false"
    :form="form"
    :form_data="form_data"
    name="summary"
    title="خلاصه"
    value="{{ $model->summary }}"
></i-textarea>

{{--<i-textarea--}}
{{--    :advance_editor="false"--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="summary_en"--}}
{{--    title="خلاصه انگلیسی"--}}
{{--    value="{{ $model->summary_en }}"--}}
{{--></i-textarea>--}}

<i-textarea
    :advance_editor="true"
    :form="form"
    :form_data="form_data"
    name="body"
    title="متن"
    value="{{ $model->body }}"
></i-textarea>

{{--<i-textarea--}}
{{--    :advance_editor="true"--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="body_en"--}}
{{--    title="متن انگلیسی"--}}
{{--    value="{{ $model->body_en }}"--}}
{{--></i-textarea>--}}

<i-checkbox
    :form="form"
    :form_data="form_data"
    name="active"
    title="وضعیت نمایش"
    :value="{{ $model->active }}"
></i-checkbox>

{{--<i-date--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="publish_date"--}}
{{--    title="تاریخ انتشار"--}}
{{--    format="YYYY-MM-DD"--}}
{{--    value="{{ $model->publish_date }}"--}}
{{--></i-date>--}}

{{--<i-date--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="expire_date"--}}
{{--    title="تاریخ انقضا"--}}
{{--    format="YYYY-MM-DD"--}}
{{--    value="{{ $model->expire_date }}"--}}
{{--></i-date>--}}


<i-uploader
    :form="form"
    :form_data="form_data"
    name="image"
    title="تصویر"
    action="{{ $model->store_uri }}"
    value="{{ $model->image }}"
></i-uploader>

<i-uploader
    :form="form"
    :form_data="form_data"
    name="image2"
    title="تصویر دوم"
    action="{{ $model->store_uri }}"
    value="{{ $model->image2 }}"
></i-uploader>

<i-uploader
    :form="form"
    :form_data="form_data"
    name="image3"
    title="تصویر سوم"
    action="{{ $model->store_uri }}"
    value="{{ $model->image3 }}"
></i-uploader>

<i-uploader
    :form="form"
    :form_data="form_data"
    name="file"
    title="فایل ضمیمه"
    action="{{ $model->store_uri }}"
    value="{{ $model->file }}"
></i-uploader>





{{--@if($model->video!==null)--}}
{{--    <div>ویدیو :</div>--}}
{{--    <div class="card-footer p-4">--}}
{{--        <video id="videoPreview" src="{{$model->video}}" controls style="width: 100%; height: auto"></video>--}}
{{--    </div>--}}
{{--@endif--}}


{{--<div class="my-16">--}}


{{--    <div class="container py-16 px-0 bg-grey-light rounded">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-8">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header text-center">--}}
{{--                        <h5>آپلود ویدیو</h5>--}}
{{--                    </div>--}}

{{--                    <div class="card-body">--}}
{{--                        <div id="upload-container" class="text-center">--}}
{{--                            <button id="browseFile" type="button" class="bg-green-dark">انتخاب ویدیو</button>--}}
{{--                        </div>--}}
{{--                        <div class="progress mt-3" style="height: 25px;display: none">--}}
{{--                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"--}}
{{--                                 aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"--}}
{{--                                 style="width: 75%; height: 100%">75%--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="card-footer p-4" style="display: none">--}}
{{--                        <video id="videoPreview" src="" controls style="width: 100%; height: auto"></video>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--@section('end-scripts')--}}

{{--    <script type="text/javascript">--}}
{{--        let browseFile = $('#browseFile');--}}
{{--        let resumable = new Resumable({--}}
{{--            target: '{{ route('content.files.upload.large',$model->id) }}',--}}
{{--            query: {_token: '{{ csrf_token() }}'},// CSRF token--}}
{{--            fileType: ['mp4'],--}}
{{--            chunkSize: 1 * 1024 * 1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini--}}
{{--            headers: {--}}
{{--                'Accept': 'application/json'--}}
{{--            },--}}
{{--            testChunks: false,--}}
{{--            throttleProgressCallbacks: 1,--}}
{{--        });--}}

{{--        resumable.assignBrowse(browseFile[0]);--}}

{{--        resumable.on('fileAdded', function (file) { // trigger when file picked--}}
{{--            showProgress();--}}
{{--            resumable.upload() // to actually start uploading.--}}
{{--        });--}}

{{--        resumable.on('fileProgress', function (file) { // trigger when file progress update--}}
{{--            updateProgress(Math.floor(file.progress() * 100));--}}
{{--        });--}}

{{--        resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete--}}
{{--            response = JSON.parse(response)--}}

{{--            $('#videoPreview').attr('src', response.path);--}}
{{--            $('.card-footer').show();--}}

{{--        });--}}

{{--        resumable.on('fileError', function (file, response) { // trigger when there is any error--}}
{{--            alert('file uploading error.')--}}
{{--        });--}}


{{--        let progress = $('.progress');--}}

{{--        function showProgress() {--}}
{{--            progress.find('.progress-bar').css('width', '0%');--}}
{{--            progress.find('.progress-bar').html('0%');--}}
{{--            progress.find('.progress-bar').removeClass('bg-success');--}}
{{--            progress.show();--}}
{{--        }--}}

{{--        function updateProgress(value) {--}}
{{--            progress.find('.progress-bar').css('width', `${value}%`)--}}
{{--            progress.find('.progress-bar').html(`${value}%`)--}}
{{--        }--}}

{{--        function hideProgress() {--}}
{{--            progress.hide();--}}
{{--        }--}}
{{--    </script>--}}

{{--@endsection--}}
