<div class="shadow  flex flex-col mt-12 ">
    <div class="

                mx-auto
                w-full
                rounded-t-3xl
                text-white
                text-sm
                lg:text-xl
                font-bold
                shadow
                bg-blue-500 py-1 lg:py-3 px-4 text-center">

        دیدگاه ها
    </div>
    <div class="p-2 lg:p-24 flex flex-col bg-light-cm rounded-b-3xl">

        @foreach($content->publishedComments as $comment)

            <div class="bg-blue-600 w-full p-2 rounded-2xl text-white my-5">
                <div class="my-2 p-2 flex flex-row">
                    <i class="w-10 h-10 rounded-full  fa fa-2xl fa-user-circle"></i>
                    <div class="font-bold mr-2">
                        @if(!is_null($comment->user_id))

                            <div class=" ">
                                {{optional($comment->user)->fullname}}
                            </div>
                        @elseIf(!is_null($comment->admin_id))
                            <div class=" ">
                                {{optional($comment->admin)->fullname}}
                            </div>
                        @else
                            <div class=" ">
                                {{'میهمان '. $comment->guest_name}}
                            </div>
                        @endif
                    </div>
                </div>


                <div class="p-2">{{$comment->description }}</div>
                <div class="p-2 text-left">

                    {{$comment->created_at_fa}}
                </div>
            </div>


            @foreach($comment->publishedComments as $subComment)
                <span class=""> <i class="fa fa-2xl fa-reply text-c-dark"> </i></span>
                <div class="bg-blue-700 w-full mr-1 lg:mr-12 p-2  rounded-2xl text-white my-5">
                    <div class="my-2 p-2 flex flex-row">
                        <i class="w-10 h-10 rounded-full  fa fa-2xl fa-user-circle"></i>
                        <div class="font-bold mr-2">
                            <h1>
                                {{$replySlug}}
                            </h1>

                            @if(!is_null($comment->user_id))

                                <div class=" ">
                                    {{optional($comment->user)->fullname}}
                                </div>
                            @elseIf(!is_null($comment->admin_id))
                                <div class=" ">
                                    {{optional($comment->admin)->fullname}}
                                </div>
                            @else
                                <div class=" ">
                                    {{'میهمان '. $comment->guest_name}}
                                </div>
                            @endif
                        </div>


                    </div>


                    <div class="p-2">{!! $subComment->description  !!}</div>
                    <div class="p-2 text-left">

                        {{$subComment->created_at_fa}}
                    </div>
                </div>

            @endforeach
        @endforeach


        <div>
            <div class="text-c-dark text-xl font-bold mt-10">

                دیدگاهتان را بنویسید

            </div>
            <div class="text-c-dark text-md  mt-10">
                نشانی ایمیل شما منتشر نخواهد شد. بخش‌های موردنیاز علامت‌گذاری شده‌اند *


            </div>


            <form method="post"
                  class="flex flex-col mt-10 border p-2"
                  action="{{ route('guest.content.comment.store',['locale'=>'fa','content'=>$content->id]) }}">
                @method('PUT')

                @csrf


                <div class="flex flex-col lg:flex-row my-10">
                    <div class="px-2 w-full py-2 lg:w-1/2 ">


                        <input name="guest_name" type="text"
                               placeholder="نام *"
                               class=" rounded p-2 w-full lg:w-full  bg-gray-100  p-2"/>

                    </div>


                    <div class="px-2 w-full py-2 lg:w-1/2">

                        <input name="email" type="text"
                               placeholder="ایمیل *"
                               class=" rounded p-2 w-full lg:w-full  bg-gray-100  p-2"/>

                    </div>
                    {{--                                    <div class="m-1">--}}

                    {{--                                        <label class="font-bold text-c-dark">5 + 4 = ?</label>--}}
                    {{--                                        <input type="text" class=" rounded p-2 w-full lg:w-fit  bg-gray-100  p-2"/>--}}

                    {{--                                    </div>--}}
                </div>
                <div class="px-2 flex justify-start flex-col lg:flex-row">
                    <label class="    font-bold text-c-dark"></label>
                    <textarea name="description" rows="8"
                              placeholder="دیدگاه *"
                              class="w-full  rounded  bg-gray-100  p-2 ">

                                    </textarea>
                </div>

                @if($errors->any())
                    <div class="text-rose-500 text-xs">
                        {!! implode('', $errors->all(":message <br>")) !!}
                    </div>
                @endif
                @if(session('success'))
                    <div
                        class="text-teal-600 bg-blue-50 border border-blue-600  rounded-2xl p-4 text-sm">
                        {{session('success')}}
                    </div>
                @endif
                <button
                    type="submit"
                    class="  py-1 transition rounded-2xl text-blue-900 border-dark-cm
                                    hover:bg-blue-900 hover:text-white border border-blue-900 cursor-pointer w-fit aboute_btn  mx-auto mt-4 p-3  ">
                                <span> فرستادن دیدگاه
                                <i class="fa fa-paper-plane"></i></span>

                </button>
            </form>
            {{--                            <div class="flex flex-col mt-10">--}}
            {{--                                <div class="flex justify-around flex-col lg:flex-row">--}}
            {{--                                    <label class="font-bold text-c-dark">دیدگاه *</label>--}}
            {{--                                    <textarea rows="8" class="w-full lg:w-3/4 rounded-xl ">--}}

            {{--                                    </textarea>--}}
            {{--                                </div>--}}

            {{--                                <div class="flex flex-col lg:flex-row mt-10">--}}
            {{--                                    <div class="m-1">--}}

            {{--                                        <label class="font-bold text-c-dark">نام *</label>--}}
            {{--                                        <input type="text" class=" rounded-xl p-2 w-full lg:w-fit  border p-2"/>--}}

            {{--                                    </div>--}}
            {{--                                    <div class="m-1">--}}

            {{--                                        <label class="font-bold text-c-dark">ایمیل *</label>--}}
            {{--                                        <input type="text" class=" rounded-xl p-2 w-full lg:w-fit  border p-2"/>--}}

            {{--                                    </div>--}}
            {{--                                    <div class="m-1">--}}

            {{--                                        <label class="font-bold text-c-dark">5 + 4 = ?</label>--}}
            {{--                                        <input type="text" class=" rounded-xl p-2 w-full lg:w-fit  border p-2"/>--}}

            {{--                                    </div>--}}
            {{--                                </div>--}}

            {{--                                <div--}}
            {{--                                    class="px-3 py-1 transition rounded-2xl cursor-pointer w-fit aboute_btn  mx-auto mt-4   ">--}}
            {{--                                <span> فرستادن دیدگاه--}}
            {{--                                <i class="fa fa-paper-plane"></i></span>--}}

            {{--                                </div>--}}
            {{--                            </div>--}}
        </div>
    </div>
</div>
