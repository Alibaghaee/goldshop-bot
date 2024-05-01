@extends(getSiteBladePath('layouts.master'))

@section('title', $content->title)







@section('content')
    <div class="w-full bg-white relative lg:mt-12">
        <img class="w-full mt-0 lg:mt-12 pt-0 lg:pt-2 brightness-75 shadow-lg object-cover" src="{{$content->image}}"
             alt=""
             style="max-height: 70vh;">
        <a href="#box"
           class="block whitespace-no-wrap w-full absolute top-0 lg:top-1/3 z-40   text-white font-bold text-xs lg:text-2xl">
            <div class="text-center mb-2 text-3xl">
                {{$content->title}}
            </div>

            @if(optional(optional($content->category_item)->category)->title || optional($content->category_item)->title )
                <div class="w-full lg:w-1/3 mx-auto flex  flex-row justify-around border-y-2 py-2">
                    @if(optional(optional($content->category_item)->category)->title)
                        <div class="flex flex-row flex-no-wrap   ">

                            <div>{{optional(optional($content->category_item)->category)->title}}</div>

                        </div>
                        <div><i class="fa fa-chevron-left  "> </i></div>
                    @endif

                    @if(optional($content->category_item)->title)




                        @if(optional($content->category_item)->parent)

                            @if(optional(optional($content->category_item)->parent)->parent)
                                <div class="flex flex-row flex-no-wrap   ">

                                    <div>{{optional(optional(optional($content->category_item)->parent)->parent)->title}}</div>

                                </div>
                                <div><i class="fa fa-chevron-left  "> </i></div>
                            @endif
                            <div class="flex flex-row flex-no-wrap   ">

                                <div>{{optional(optional($content->category_item)->parent)->title}}</div>
                            </div>
                            <div><i class="fa fa-chevron-left  "> </i></div>
                        @endif

                        <div class="flex flex-row flex-no-wrap   ">


                            <div>{{optional($content->category_item)->title}}</div>

                        </div>
                        <div><i class="fa fa-chevron-left  "> </i></div>
                    @endif
                    <div class="flex flex-row flex-no-wrap  ">
                        {{$content->title}}
                    </div>


                </div>

            @endif
        </a>

    </div>

    @if($content->is_bime)
        <div class="flex flex-col lg:flex-row ">
            <div class="w-full lg:w-1/4 bg-white">
                <div
                    class=" lg:sticky pt-12 top-2 right-2 flex flex-col w-full lg:w-fit mt-2 text-center text-gray-600 font-bold">
                    <div class="w-full h-full mb-1 ">
                        <img class="mx-auto" src="{{$content->image3}}" alt="">
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-3/4 bg-white  ">

                <div class="container py-12" id="box">
                    <div class="w-fit mx-auto h-full">
                        <img class="mx-auto w-fit" src="{{$content->image2}}" alt="">
                    </div>
                    <div class="mt-4  text-gray-600 w-full lg:w-3/4 mx-auto" style="line-height: 2.2rem;">
                        {!! $content->body !!}

                    </div>


                    <div class="mt-4  text-gray-600 ">
                        @if(!is_null($content->file))
                            <a class="block text-white py-2 px-5 bg-blue-500 w-fit mx-auto rounded"
                               href="{{$content->file}}">دانلود فایل</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    @else

        <div class="w-full bg-white  ">

            <div class="container py-12" id="box">
                <div class="mt-4  text-gray-600 w-full lg:w-3/4 mx-auto" style="line-height: 2.2rem;">
                    {!! $content->body !!}

                </div>


                <div class="mt-4  text-gray-600 ">
                    @if(!is_null($content->file))
                        <a class="block text-white py-2 px-5 bg-blue-500 w-fit mx-auto rounded"
                           href="{{$content->file}}">دانلود فایل</a>
                    @endif

                </div>
            </div>
        </div>

    @endif
@endsection

@section('end-scripts-one')
    <script>
        $('.playVideoBtn').click(function (event) {

            // $('#videoPreview').attr('controls','true')
            $('#videoPreview').attr('controls', true);

            // $('#videoPreview').autoplay = true;
            // $('#videoPreview').load();
            document.querySelector("#videoPreview").play();
            $(this).addClass('hidden')
            $('.titleVideo').addClass('hidden')
        })
    </script>


@endsection


