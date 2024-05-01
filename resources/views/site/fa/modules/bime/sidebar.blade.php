<!-- mobile menu  -->
<div class="sidebar transition-all duration-500 fixed right-[-250px] bottom-0 top-0 w-[250px]
     py-8 px-6 bg-slate-300 z-50 rounded-l">
    <search-box></search-box>
    <nav class="">
        <ul class="flex flex-col b xl:hidden gap-4 items-center text-[1rem] 2xl:text-[1.1rem]">
            <li><a href="{{route('home.index',['local'=>'fa'])}}">صفحه اصلی</a></li>
            <li><a href="{{route('page.index',['local'=>'fa'])}}">مطالب</a></li>


            @foreach($nav_menu->patentItems as $sub_menu)

                @if($sub_menu->children()->exists())

                    <li class="hover:text-white  block rounded-t w-full text-center "><a
                            href="#">{{$sub_menu->title}}</a>
                        <ul class=" z-50  w-full text-center  ">
                            @forelse($sub_menu->children as $sub_sub_menu)

                                @if($sub_sub_menu->children()->exists())
                                    <li class="inline-block px-2 w-full text-center    "><a
                                            href="#">{{$sub_sub_menu->title}}</a>
                                        <ul>

                                            @forelse($sub_sub_menu->children as $sub_sub_sub_menu)
                                                <li class="rounded-l block "><a href="{{ $sub_sub_sub_menu->link }}"
                                                                                @if(\Illuminate\Support\Str::startsWith($sub_sub_sub_menu->link, '/#')) data-turbolinks="false"
                                                        @endif
                                                    >{{$sub_sub_sub_menu->title}}</a></li>
                                            @empty
                                            @endforelse

                                        </ul>
                                    </li>
                                @else
                                    <li class="block w-full text-center  "><a href="{{ $sub_sub_menu->link }}"
                                                                              class=" ml-3"
                                                                              @if(\Illuminate\Support\Str::startsWith($sub_sub_menu->link, '/#')) data-turbolinks="false" @endif>
                                            {{ $sub_sub_menu->title }}
                                        </a></li>
                                @endif
                            @empty
                            @endforelse
                        </ul>
                    </li>

                @else
                    <li class=" "><a href="{{ $sub_menu->link }}" class="nav-item px-1"
                                     @if(\Illuminate\Support\Str::startsWith($sub_menu->link, '/#')) data-turbolinks="false" @endif>
                            {{ $sub_menu->title }}
                        </a></li>
                @endif

            @endforeach


            <li><a href="#contactUs">تماس با ما</a></li>

        </ul>


    </nav>
</div>

<!-- overlay -->
<div class="overlay transition-all duration-500 fixed inset-0 bg-black/70 z-[39] invisible opacity-0"></div>

<!-- header -->
<header class="p-4 flex justify-between items-center text-primary">
    <div class="flex items-center gap-2">
        <img
            class="w-[80px] sm:w-[120px] h-[60px] sm:h-[80px]"
            src="{{asset('/image/site/logo.png')}}"
            alt="اﯾﺮاﻧﯿﺎن ﺳﺮﻣﺎﯾﻪ و آﺳﺎﯾﺶ اﻣﯿﺪ اى ﺑﯿﻤﻪ ﺧﺪﻣﺎت ﺷﺮکﺖ"/>
        <div class="font-bold text-md flex flex-col  ">
            <div class="  lg:whitespace-no-wrap">شرکت خدمات بیمه ای امید آسایش و سرمایه ایرانیان</div>
            <div class="text-right">کد ۱۰۰۰۷</div>
         </div>
    </div>
    <nav class="flex mr-2  w-full justify-around   ">
        <ul class="hidden xl:flex  whitespace-nowrap " style="color:#488ae1">


            <li class=" hoverabletext   rounded" >
                <a style="color: #007aff!important;" class="block text-sm " href="{{route('home.index' ,['local'=>'fa'])}}">صفحه اصلی</a></li>
{{--            <li class=""><a class="block" href="{{route('page.index',['local'=>'fa'])}}">خدمات آنلاین</a></li>--}}


            @foreach($nav_menu->patentItems as $sub_menu)

                @if($sub_menu->children()->exists())

                    <li class=" block rounded-t w-fit "><a href="#" class=" hoverabletext text-sm" style="color: #007aff!important;">{{$sub_menu->title}}</a>
                        <ul class="absolute z-50 text-sm">
                            @forelse($sub_menu->children as $sub_sub_menu)

                                @if($sub_sub_menu->children()->exists())
                                    <li class=" block rounded-b px-2   shadow-lg"><a href="#">{{$sub_sub_menu->title}}</a>
                                        <ul>

                                            @forelse($sub_sub_menu->children as $sub_sub_sub_menu)
                                                <li class="rounded-l text-white block"><a href="{{ $sub_sub_sub_menu->link }}"
                                                                               @if(\Illuminate\Support\Str::startsWith($sub_sub_sub_menu->link, '/#')) data-turbolinks="false"
                                                        @endif
                                                    >{{$sub_sub_sub_menu->title}}</a></li>
                                            @empty
                                            @endforelse

                                        </ul>
                                    </li>
                                @else
                                    <li class=" block rounded-b px-2   shadow-lg"><a href="{{ $sub_sub_menu->link }}" class=" ml-3"
                                                         @if(\Illuminate\Support\Str::startsWith($sub_sub_menu->link, '/#')) data-turbolinks="false" @endif>
                                            {{ $sub_sub_menu->title }}
                                        </a></li>
                                @endif
                            @empty
                            @endforelse
                        </ul>
                    </li>

                @else
                    <li class="text-sm  px-1"><a href="{{ $sub_menu->link }}" class="nav-item px-1  font-bold hoverabletext"
                                             style="color: #007aff;"
                                     @if(\Illuminate\Support\Str::startsWith($sub_menu->link, '/#')) data-turbolinks="false" @endif>
                            {{ $sub_menu->title }}
                        </a></li>
                @endif

            @endforeach


{{--            <li class="hoverabletext  rounded"><a href="#contactUs">تماس با ما</a></li>--}}


        </ul>
        <div class="flex gap-1 items-center xl:self-end">
            <div class="ham-menu xl:hidden">
                <span class="line line1 bg-primary"></span>
                <span class="line line2 bg-primary"></span>
                <span class="line line3 bg-primary"></span>
            </div>
            <img class="search w-8 sm:w-12 xl:w-8 xl:h-8 xl:translate-y-[2px]"
                 src="{{asset('/image/site/Search.svg')}}" alt="">
        </div>
    </nav>

    {{--    <div class="hidden xl:flex ml-6 text-slate-500">--}}
    {{--        <a href="#">ثبت ﻧﺎم</a>--}}
    {{--        <span>/</span>--}}
    {{--        <a href="#">ورود</a>--}}
    {{--    </div>--}}
</header>
