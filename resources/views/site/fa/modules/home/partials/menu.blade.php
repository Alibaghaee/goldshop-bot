<div class="text-purple-darkest hidden md:block border-b-2 border-grey-lightest">
    <div class="flex flex-wrap w-full justify-between container">
        <div class="flex flex-wrap items-center py-6">
            {{-- <div class="px-6">
                <a href="/"><img src="{{ setting(config('portal.setting_id.header_logo')) }}" class="-my-4 w-16" alt="logo"></a>
            </div> --}}
            @if(auth()->guard('web')->check())
            <div class="flex flex-wrap items-center">
                @foreach($nav_menu->items as $item)
                <a href="{{ $item->link }}" class="no-underline bg-blue hover:bg-blue-dark rounded py-2 px-3 md:px-6 text-white cursor-pointer h-12 flex items-center justify-center text-center ml-3">{{ $item->title }}</a>
                @endforeach
            </div>
            @endif
        </div>
        <div class="flex py-6">
            @if(auth()->guard('web')->check())
            {{-- <a href="{{ route('cart.index', app()->getLocale()) }}" class="no-underline bg-green-light hover:bg-green rounded py-2 px-3 md:px-6 text-white cursor-pointer h-12 flex items-center justify-center text-center ml-3">
                <span class="ml-2" v-if="total_count !=0">@{{ total_count }}</span>
                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 384"><path d="M96 336c-13.248 0-24 10.752-24 24s10.752 24 24 24 24-10.752 24-24-10.752-24-24-24zm224.5 0c-13.248 0-24 10.752-24 24s10.752 24 24 24 24-10.752 24-24-10.752-24-24-24zM384 64L59.177 31.646c-1.628-6.972-4.369-14.66-11.838-20.667C38.025 3.489 22.982 0 0 0v16.001c18.614 0 31.167 2.506 37.312 7.447 4.458 3.585 5.644 8.423 7.165 15.989l-.024.004 42.052 233.638c2.413 14.422 7.194 25.209 13.291 32.986C107.043 315.312 116.533 320 128 320h240v-16H128c-4.727 0-19.136.123-25.749-33.755l-5.429-30.16L368 192l16-128z"/></svg>
            </a> --}}
            {{-- <a href="{{ route('dashboard.index', app()->getLocale()) }}" class="no-underline bg-green-light hover:bg-green rounded py-2 px-3 md:px-6 text-white cursor-pointer h-12 flex items-center justify-center text-center ml-3">سفارشات من</a> --}}

            <a href="{{ route('profile.edit', [app()->getLocale(), auth()->id()]) }}" class="no-underline bg-green-light hover:bg-green rounded py-2 px-3 md:px-6 text-white cursor-pointer h-12 flex items-center justify-center text-center ml-3">ویرایش پروفایل</a>
            
            <div class="cursor-pointer h-full hover:bg-grey-lighter rahco-center">
                <a href="{{ route('logout', app()->getLocale()) }}" 
                    class="no-underline border-2 border-pink-dark cursor-pointer flex h-12 hover:bg-pink-dark hover:text-white items-center justify-center leading-normal rounded text-pink-dark text-white py-4 px-6" 
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    خروج
                </a>

                <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
            @else 
            <a href="/" class="no-underline bg-blue-light hover:bg-blue rounded py-2 px-3 md:px-6 text-white cursor-pointer h-12 flex items-center justify-center text-center ml-3">خانه</a>
            {{-- <a href="{{ route('login', app()->getLocale()) }}" class="no-underline bg-blue-light hover:bg-blue rounded py-2 px-3 md:px-6 text-white cursor-pointer h-12 flex items-center justify-center text-center">ورود به پنل کاربری</a> --}}
            {{-- <a href="{{ route('registration.index', app()->getLocale()) }}" class="no-underline bg-green-light hover:bg-green rounded py-2 px-3 md:px-6 text-white cursor-pointer h-12 flex items-center justify-center w-32 text-center">ثبت نام</a> --}}
            @endif
        </div>
    </div>
</div>

<div class="block md:hidden">
    @if(auth()->guard('web')->check())
    <div id="mySidenav" class="sidenav">
        <div class="closebtn" onclick="closeNav()">&times;</div>
        @foreach($nav_menu->items as $item)
        <a href="{{ $item->link }}" class="">{{ $item->title }}</a>
        @endforeach
    </div>

    <div class="text-purple-darkest cursor-pointer text-xl py-4 px-4 flex justify-between items-center">
        <svg onclick="openNav()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1536 1280" class="fill-current w-6 h-6"><path d="M1536 1088v128q0 26-19 45t-45 19H64q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h1408q26 0 45 19t19 45zm0-512v128q0 26-19 45t-45 19H64q-26 0-45-19T0 704V576q0-26 19-45t45-19h1408q26 0 45 19t19 45zm0-512v128q0 26-19 45t-45 19H64q-26 0-45-19T0 192V64q0-26 19-45T64 0h1408q26 0 45 19t19 45z"></path></svg>

        <div class="flex text-sm">
            <a href="{{ route('package.index', [app()->getLocale()]) }}" class="no-underline bg-green-light hover:bg-green rounded py-2 px-3 md:px-6 text-white cursor-pointer h-12 flex items-center justify-center text-center ml-3">
                <svg class="w-6 h-6 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M169.6 377.6c-22.882 0-41.6 18.718-41.6 41.601 0 22.882 18.718 41.6 41.6 41.6s41.601-18.718 41.601-41.6c-.001-22.884-18.72-41.601-41.601-41.601zM48 51.2v41.6h41.6l74.883 151.682-31.308 50.954c-3.118 5.2-5.2 12.482-5.2 19.765 0 27.85 19.025 41.6 44.825 41.6H416v-40H177.893c-3.118 0-5.2-2.082-5.2-5.2 0-1.036 2.207-5.2 2.207-5.2l20.782-32.8h154.954c15.601 0 29.128-8.317 36.4-21.836l74.882-128.8c1.237-2.461 2.082-6.246 2.082-10.399 0-11.446-9.364-19.765-20.8-19.765H135.364L115.6 51.2H48zm326.399 326.4c-22.882 0-41.6 18.718-41.6 41.601 0 22.882 18.718 41.6 41.6 41.6S416 442.082 416 419.2c0-22.883-18.719-41.6-41.601-41.6z"/></svg>
            </a>
            
            <a href="{{ route('profile.edit', [app()->getLocale(), auth()->id()]) }}" class="no-underline bg-green-light hover:bg-green rounded py-2 px-3 md:px-6 text-white cursor-pointer h-12 flex items-center justify-center text-center ml-3">ویرایش پروفایل</a>
            
            <div class="cursor-pointer h-full hover:bg-grey-lighter rahco-center">
                <a href="{{ route('logout', app()->getLocale()) }}" 
                    class="no-underline border-2 border-pink-dark cursor-pointer flex h-12 hover:bg-pink-dark hover:text-white items-center justify-center leading-normal rounded text-pink-dark text-white py-4 px-8" 
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    خروج
                </a>
                <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div> 
            
        </div>
    </div>

    @else
    <div class="text-purple-darkest cursor-pointer text-xl py-4 px-4 flex justify-between items-center">
        <div class="flex text-sm">
            <a href="/" class="no-underline bg-blue-light hover:bg-blue rounded py-2 px-3 md:px-6 text-white cursor-pointer h-12 flex items-center justify-center text-center ml-3">خانه</a>
            {{-- <a href="{{ route('login', app()->getLocale()) }}" class="no-underline bg-blue-light hover:bg-blue rounded py-2 px-3 md:px-6 text-white cursor-pointer h-12 flex items-center justify-center text-center">ورود به پنل کاربری</a> --}}
        </div>
    </div>
    @endif
</div>

@section('end-scripts-two')
<script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "100%";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }
</script>
@endsection
