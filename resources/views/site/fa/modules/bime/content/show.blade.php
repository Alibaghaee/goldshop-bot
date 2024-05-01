@extends(getSiteBladePath('layouts.master'))

@section('title', $content->title)



@section('content')
    <section class="   pt-12 pb-16 md:py-4 bg-end-page bg-white">
        <div class="py-12 pb-16
        grid grid-cols-10">
            <div class="col-span-10 lg:col-span-7   border rounded   mx-2 pb-8">
                <div class="flex flex row justify-between border-b text-xs lg:text-md">

                    <div class="px-4 py-2  text-gray-500">

                        {{optional(optional($content->category_item)->category)->title}}
                        /
                        {{optional($content->category_item)->title}}
                    </div>
                    <div class="flex flex-row p-2 bg-blue-400 text-white  ">
                        <div id="increaseFontSize"
                             class="my-auto  mx-2 border hover:bg-white hover:text-blue-400  p-2"><i
                                class="fa fa-plus"></i></div>
                        <div class="my-auto  mx-2  text-yellow p-2 contentBox"><i class="fa   fa-font"></i></div>
                        <div id="decreaseFontSize"
                             class="my-auto  mx-2  border hover:bg-white hover:text-blue-400 p-2"><i
                                class="fa fa-minus"></i></div>
                    </div>
                    <div class="flex flex-row">
                        <div class="px-4 py-2  text-gray-400 ">
                            <i class="fa  fa-calendar  "></i>

                            {{$content->created_at_fa}}
                        </div>
                        <a href="#"
                           onclick="window.print()"
                           class="block px-4 py-2  text-gray-400 "><i
                                class="fa fa-2x  transition text-blue-500 fa-print"></i></a>
                    </div>
                </div>
                <div class="container contentBox">

                    <div class="mx-auto lg:px-10">

{{--                        <h2 class=" text-md text-gray-700 font-bold my-10 py-4">--}}
{{--                            {{$content->title}}--}}
{{--                        </h2>--}}
                        <h2 class="pb-2 text-gray-700    font-bold py-4 ">
                            {{$content->html_title}}
                        </h2>

                        <div class="w-full  mx-auto bg-gray-200 px-1 rounded text-primary py-8 line-height-2-5">

                            {{$content->summary}}
                        </div>


                        <div
                            class="min-w-[300px] flex flex-col lg:flex-row justify-center rounded-md overflow-hidden  mt-3 pt-2">
                            <img class="w-full   lg:h-2/3 mx-auto  border-8 border-white  rounded rounded-lg"
                                 src="{{asset($content->image)}}"
                                 alt="{{$content->title}}"/>

{{--                            <div class="flex flex-row lg:flex-col justify-center lg:justify-end px-2 ">--}}
{{--                                <a href="{{$content->telegram_share}}" class="block  py-2"><i--}}
{{--                                        class="fa fa-2x  transition hover:text-blue-500 fa-telegram"></i></a>--}}
{{--                                <a href="{{$content->twitter_share}}" class="block  py-2"><i--}}
{{--                                        class="fa fa-2x  transition hover:text-blue-500 fa-twitter"></i></a>--}}
{{--                                <a href="{{$content->facebook_share}}" class="block pr-2 py-2"><i--}}
{{--                                        class="fa fa-2x  transition hover:text-blue-500 fa-facebook"></i></a>--}}

{{--                                <a href="{{$content->gmail_share}}" class="block pr-2 py-2"><i--}}
{{--                                        class="fa fa-2x  transition hover:text-blue-500 fa-google"></i></a>--}}

{{--                                <a href="{{$content->sms_share}}" class="block pr-2 py-2"><i--}}
{{--                                        class="fa fa-2x  transition hover:text-blue-500 fa-envelope"></i></a>--}}

{{--                            </div>--}}
                        </div>
                        <div class="w-full  mx-auto">

                            <div class=" py-8 line-height-2-5">

                                {!! $content->body !!}

                            </div>




                            <div class=" py-8 line-height-2-5">
                                @if($content->file)
                                    <a class="text-blue-dark" href="{{ $content->file }}">دانلود فایل</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 ">

                        {{--                        <div>--}}
                        {{--                            <div--}}
                        {{--                                class="text-center text-gray-900 font-semibold p-2 border-b-2 border-blue-500 w-fit mx-auto my-4">--}}
                        {{--                                اشتراک گذاری--}}
                        {{--                            </div>--}}
                        {{--                            <div class="flex flex-row justify-center">--}}
                        {{--                                <a href="{{$content->telegram_share}}" class="block mx-2 px-2"><i--}}
                        {{--                                        class="fa fa-2x  transition hover:text-blue-500 fa-telegram"></i></a>--}}
                        {{--                                <a href="{{$content->twitter_share}}" class="block mx-2 px-2"><i--}}
                        {{--                                        class="fa fa-2x  transition hover:text-blue-500 fa-twitter"></i></a>--}}
                        {{--                                <a href="{{$content->facebook_share}}" class="block mx-2 px-2"><i--}}
                        {{--                                        class="fa fa-2x  transition hover:text-blue-500 fa-facebook"></i></a>--}}
                        {{--                                <a href="#"--}}
                        {{--                                   onclick="window.print()"--}}
                        {{--                                   class="block mx-2 px-2"><i--}}
                        {{--                                        class="fa fa-2x  transition hover:text-blue-500 fa-print"></i></a>--}}

                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        <div>
                            <div
                                class="text-center text-gray-900 font-semibold p-2 border-b-2 border-blue-500 w-fit mx-auto my-4">
                                لینک کوتاه
                            </div>
                            <div class="w-full ">
                                <input type="text" readonly
                                       class="border border-blue-500 w-full text-gray-500 p-2 mx-auto block text-center"
                                       value="{{route('content.short_link_show',['locale'=>'fa','content'=>$content->id])}}">
                            </div>
                        </div>
                    </div>

                    @include('site.fa.modules.bime.content.comment.comment',['content'=>$content])
                </div>


                @if(isset($socialMedia)&& !is_null($socialMedia))

                    <div
                        class="flex flex-row border rounded-lg relative px-12 mt-12 pt-4 justify-center w-full lg:w-2/3 mx-auto">
                        <div class="absolute text-sm left-2/2
                          -top-3 w-fit text-center  bg-blue-700  px-2 py-1 rounded text-white">
                            مارا در شبکه های اجتماعی دنبال کنید
                        </div>
                        @foreach($socialMedia->items->sortBy('order') as $item)
                            <div class="pr-3  py-2">

                                <div class="flex flex-row justify-around">
                                    <a
                                        href="{{$item->link}}"
                                        class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-400 mx-0"
                                    >
                                        <img class=' px-0 '
                                             style="width: 55px;height: 50px;"
                                             src="{{$item->image}}" alt="{{$item->title}}"
                                        >
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif


            </div>

            <div class="col-span-10 lg:col-span-3 px-5  ">
                @include('site.fa.modules.bime.content.mostview',['populars'=>$populars])
            </div>
        </div>
    </section>

@endsection


@section('end-scripts-two')
    <script>
        $(document).ready(function () {
            let fontSize = 2;
            $('.contentBox').css({fontSize: '1rem'})

            $('#increaseFontSize').click(function () {
                if (fontSize === 1) {
                    $('.contentBox').css({fontSize: '0.875rem'})
                    fontSize = fontSize + 1
                } else if (fontSize === 2) {

                    $('.contentBox').css({fontSize: ' 1rem'})
                    fontSize = fontSize + 1

                } else if (fontSize === 3) {

                    $('.contentBox').css({fontSize: '1.125rem'})
                    fontSize = fontSize + 1

                } else if (fontSize === 4) {

                    $('.contentBox').css({fontSize: '1.25rem'})
                    fontSize = fontSize + 1

                } else if (fontSize === 5) {

                    $('.contentBox').css({fontSize: '1.5rem'})
                    fontSize = fontSize + 1
                } else if (fontSize === 6) {

                    $('.contentBox').css({fontSize: '1.875rem'})
                    fontSize = fontSize + 1
                } else if (fontSize === 7) {

                    $('.contentBox').css({fontSize: '2.25rem'})
                    fontSize = fontSize + 1
                }

            });

            //
            $('#decreaseFontSize').click(function () {
                if (fontSize === 1) {
                    $('.contentBox').css({fontSize: '0.75rem'})
                    fontSize = 1
                } else if (fontSize === 2) {

                    $('.contentBox').css({fontSize: '0.875rem'})
                    fontSize = fontSize - 1

                } else if (fontSize === 3) {

                    $('.contentBox').css({fontSize: '1rem'})
                    fontSize = fontSize - 1

                } else if (fontSize === 4) {

                    $('.contentBox').css({fontSize: '1.25rem'})
                    fontSize = fontSize - 1

                } else if (fontSize === 5) {

                    $('.contentBox').css({fontSize: '1.5rem'})
                    fontSize = fontSize - 1
                } else if (fontSize === 6) {

                    $('.contentBox').css({fontSize: '1.875rem'})
                    fontSize = fontSize - 1
                } else if (fontSize === 7) {

                    $('.contentBox').css({fontSize: '2.25rem'})
                    fontSize = fontSize - 1
                } else if (fontSize === 8) {

                    $('.contentBox').css({fontSize: '2.25rem'})
                    fontSize = fontSize - 1
                }

            });

        })

    </script>


@endsection
