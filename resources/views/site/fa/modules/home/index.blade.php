@extends(getSiteBladePath('layouts.master'))

@section('title', 'بیمه امید آسایش  و سرمایه ایرانیان')


@section('metaDescription', 'شرکت خدمات بیمه ای امید آسایش و سرمایه ایرانیان')

@section('content')

    <!-- hero content -->
    <section class="bg-section bg-cover gap-4 lg:pt-40 pb-12 pt-4 lg:pb-52 relative">
        <div class="container relative flex lg:block flex-col sm:justify-center">
            @if($firstSection)
                <img class="lg:hidden" src="{{$firstSection->image}}" alt="{{$firstSection->name}}">
                <div class="inline-block relative z-20 w-full">


                    <h2 class="text-primary text-2xl md:text-4xl flex flex-col !leading-normal">
                        {{$firstSection->name}}
                    </h2>

                    <span class="text-black mt-6 mb-6 md:mb-12 inline-block text-[1.7rem] md:text-[2.9rem]"
                    >{!! $firstSection->description !!}</span>


                    <div class="flex gap-4 font-bold md:px-8  sm:w-full    ">
{{--                        <button--}}
{{--                            class="rounded-lg border-2 border-primary bg-primary text-white px-2 py-3 md:px-8  ">--}}
{{--                            دریافت اپلیکیشن--}}
{{--                        </button>--}}
                        <a href="{{$giveNumber->link}}"
                           style="border-color: #06b6d4;color: #06b6d4;"
                           class="rounded-lg border-2  text-primary px-2 py-3 md:px-8  md:px-8   ">
                            {{$giveNumber->name}}
                        </a>
                    </div>
                </div>
                <img class="hidden lg:block w-[300px] lg:w-[500px] object-cover
        absolute left-[50px] lg:left-0 top-[-340px] lg:top-[-100px]" src="{{$firstSection->image}}"
                     alt="{{$firstSection->name}}">

            @endIf
        </div>
        <!-- <img class="absolute"/img/home.png" alt=""> -->
    </section>

    <!--  -->
    <div class="container  lg:flex gap-2 text-xl p-2 justify-right">
      <span
          class="text-red-700 font-bold truncate whitespace-nowrap"
          style="overflow: initial">
        اطلاعیه ها :
      </span>
        @if(isset($publicNotifications) && $publicNotifications!==null)
            <public-notification :public_notifications="{{$publicNotifications}}"></public-notification>
        @endIf
    </div>


    <!-- services -->
    <section class="bg-section py-12">
        <div class="container">
            @if($slider)
                <div
                    class="max-w-[700px] mx-auto my-10 flex justify-center items-center">
                    <div class="grow h-[3px] bg-primary"></div>
                    <h2 class="text-3xl font-bold mx-3 text-primary">{{$slider->name}} </h2>
                    <div class="grow h-[3px] bg-primary"></div>
                </div>

                <!-- Swiper -->
                <div class="mySwiperMain flex gap-12">
                    <div class="relative w-[20px]">
                        <div class="swiper-button-next text-primary top-[50%]"  ></div>
                    </div>
                    <div class="swiper mySwiper " style="padding-top: 3rem;  ">
                        <div class="swiper-wrapper gap-0 " >
                            @foreach($slider->items as $item)

                                <div class="swiper-slide flex-col px-4  border-l border-blue-darker " >
                                    <img src="{{$item->image}}" alt="{{$item->title}}"/>
                                    <a href="{{$item->link}}" class="text-primary text-xl">{{$item->title}}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="relative w-[20px]">
                        <div class="swiper-button-prev text-primary top-[50%] "  ></div>
                    </div>
                </div>
            @endIf
        </div>
    </section>




    <section class="py-12 pb-16 bg-slate-100">


        <div class="container">
            @if($newsEvent)
                <h2 class="  text-center text-3xl text-primary font-bold  ">
                    {{$newsEvent->name}}
                </h2>
{{--                <news-event :items="{{$newsEvent->items}}"></news-event>--}}
                <!-- blog cards -->
                <div class="newsSwiperMain flex gap-12 pb-6  ">
                    <div class="relative ">
                        <div class="swiper-button-next text-white top-[50%]" style="color: blue"></div>
                    </div>
                    <div class="swiper newsSwiper " style="padding-top: 3rem;">
                        <div class="swiper-wrapper gap-2 ">
                            @foreach($newsEventItem as $item)

                                <div class="swiper-slide flex-col  " style="height: 100%!important;">
                                    <div class=" flex flex-col justify-between rounded-md overflow-hidden bg-white 	"
                                         style="min-width: 200px;min-height: 300px;height: 100%!important; ">
                                        <div class=" flex flex-col">
                                            <img class=" w-fit" src="{{$item->image}}" alt="{{$item->title}}"
                                                 style="width: 100%;height: 10rem;"/>
                                            <div
                                                class="justify-self-start text-black font-bold text-xs text-justify p-1">
                                                {{ $item->title }}
                                            </div>
                                        </div>


                                        <div class="py-2 px-1 " style="height: 100%;">

                                            <div class="flex flex-col lg:flex-row justify-center lg:justify-between mt-4 text-xs border-t">
                                                <div class="mt-3"
                                                     style="color: #0891b2;">{{ $item->created_at_fa }}</div>
                                                <a href="{{$item->url}}"
                                                   class="block cursor-pointer text-xs" style="color: #0ba2d4;">بیشتر
                                                    بخوانید</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                            @endforeach
                        </div>
                    </div>
                    <div class="relative ">
                        <div class="swiper-button-prev text-blue top-[50%] " style="color: blue"></div>
                    </div>
                </div>
                <!-- blog cards -->

                <a class="block float-left text-blue-600 my-auto " href="{{route('content.index',['locale'=>'fa'])}}">
                    مطالب بیشتر
                    <i class="fa fa-chevron-left"></i>
                </a>
            @endIf
        </div>
    </section>

    <!-- services -->
    <section class="   flex relative" style="min-height: 400px;">
        <div class="bg-blue-800/90 absolute inset-0 clip-path">
            <div class="container  absolute inset-0 mt-20 md:mt-24  flex-col ">
                @if($counseling)
                    <div class="inline-block ">
                        <h2 class="text-white text-xl md:text-2xl xl:text-3xl flex flex-col !leading-normal animate-charcter">
                            <span>{{$counseling->name}}</span>
                        </h2>

                        <div class="flex flex-col w-full items-start">
              <span class="text-white mt-4 mb-4 inline-block text-[1.7rem] md:text-[2rem] xl:text-[2.9rem]"
              >
                  {!! $counseling->description !!}
              </span>

                            <a href="{{$serviceBimehBtn->link}}"
                               class="block rounded-lg border-2 text-white border-white text-wborder-white px-2 py-3 md:px-8 inline-block">

                                {{$serviceBimehBtn->name}}
                            </a>
                        </div>
                    </div>

                @endif

            </div>
        </div>
        <div class="bg-services bg-cover bg-center md:w-2/4"></div>
        <div class="bg-services bg-cover bg-center w-full md:w-2/4"></div>
    </section>

    <!-- contact us -->

@endsection


