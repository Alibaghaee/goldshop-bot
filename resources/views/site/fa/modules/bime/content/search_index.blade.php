@extends(getSiteBladePath('layouts.master'))

@section('title', $title)




@section('content')
    <section class="  pb-16   mb-32  bg-end-page2 bg-cover bg-white">
        <div class="py-12 pb-16
        grid grid-cols-10">
            <div></div>
            <div class="col-span-10 lg:col-span-6       mx-2 ">


                <div class="container ">
                    <h2 class="text-center text-3xl text-primary font-bold mb-10">
                    </h2>

                    <!-- blog cards -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 content-center items-center ">
                        @php
                            $conter=1;
                        @endphp
                        @forelse($contents as $content)

                            @if($conter===1)

                                <div class="col-span-2 lg:col-span-2">

                                    <div
                                        onclick="window.location.href='{{$content->url}}'"
                                        class=" hover:brightness-90    block relative w-full h-full "
                                        style="height: 15rem;">

                                        <img class="w-full object-cover " src="{{$content->image}}" alt=""
                                             style="border-radius:0 30px 0 30px;height: 100%;">

                                        <div
                                            class="absolute text-white font-bold h-12 text-xs p-2 w-full  cursor-pointer bg-black bg-opacity-50 text-justify"
                                            style="bottom:0rem;right:0rem;left:0rem;border-radius:0 0 0 30px;">
                                            <div>
                                                {{optional($content)->title}}
                                            </div>

                                         </div>
                                    </div>
                                </div>


                            @elseif($conter >=2 && $conter<=5)
                                <div
                                    onclick="window.location.href='{{$content->url}}'"
                                    class="col-span-2 lg:col-span-1  cursor-pointer flex flex-col rounded-md overflow-hidden bg-white
                                    h-full shadow-lg hover:brightness-75 transition-all  ">
                                    <img style="height: 8rem;" class="object-cover"
                                         src="{{asset($content->image)}}"
                                         alt="{{$content->title}}"
                                    />
                                    <div class="p-2 flex flex-col justify-around h-1/2" style="min-height: 2rem;">
                                        <a href="{{$content->url}}"
                                           class="block p-1 text-black    font-bold text-xs text-justify">
                                            {{$content->title}}
                                        </a>
                                        <h1 class="  block  p-1 text-gray-500    text-xs text-justify ">
                                            {{str_limit($content->html_title ,150,'...')}}
                                        </h1>

                                    </div>
                                </div>


                            @else
                                <div
                                    onclick="window.location.href='{{$content->url}}'"
                                    class="col-span-2 lg:col-span-3  cursor-pointer flex flex-col lg:flex-row rounded-md overflow-hidden bg-white   shadow-lg hover:brightness-75 transition-all  ">
                                    <img class="h-full object-cover w-full lg:w-1/3 object-cover "
                                         src="{{asset($content->image)}}"
                                         alt="{{$content->title}}"
                                         style="min-height: 16rem;"/>
                                    <div class="p-5">
                                        <a href="{{$content->url}}"
                                           class="block  pb-2 text-gray-500  text-xs text-justify ">
                                            {{$content->title}}
                                        </a>
                                        <h2 class="  pb-2 text-gray-700  text-md font-bold text-justify ">
                                            {{$content->html_title}}
                                        </h2>
                                        <div class="flex flex-col justify-between mt-4">
                                            <div class="w-full border-b">
                                            <span
                                                class="text-gray-400 text-xs border-b-2 border-green-500">{{ $content->created_at_fa }}</span>
                                            </div>
                                            <div class="py-2 text-gray-500 text-justify">
                                                {{str_limit($content->summary ,200,'...')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @php
                                $conter++;
                            @endphp
                        @empty

                            <div class=" font-bold text-red-500 mx-auto mt-20">موردی یافت نشد!</div>
                        @endforelse


                    </div>
                    <div class="w-full mt-10 ">
                        <div class="mx-auto ">
                            {!! $contents->links() !!}
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </section>

@endsection
