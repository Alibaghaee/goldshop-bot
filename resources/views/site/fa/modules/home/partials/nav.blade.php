<div class="shadow-inner py-2 bg-teal">
    {{-- <div class="container py-8 flex flex-wrap justify-between items-center">
        <div class="w-full md:w-1/2">
            <a href="{{ $nav_menu_above->items->first()->link }}" class="block">
                <img class="h-12" src="{{ $nav_menu_above->items->first()->image }}" alt="{{ $nav_menu_above->items->first()->title }}">
            </a>
        </div>
        <div class="w-full md:w-1/2 font-bold text-black flex justify-end">
            {!! $nav_menu_above->items->last()->description !!}
        </div>
    </div> --}}
    <div class="container">
        <div class="flex flex-row-reverse flex-wrap items-center justify-between w-full">
            <div>
                @foreach(config('portal.locales') as $local)
                    <a href="/{{ $local }}" class="locale-btn @if(app()->getLocale() == $local) locale-btn-selected @endif">{{ $local }}</a>
                @endforeach
            </div>
            <div>
                <img class="h-10" src="{{ $nav_menu->image }}" alt="">
            </div>
        </div>
    </div>
</div>
<div class="border-b border-grey-lighter">
    <div class="container">
        <div class="flex flex-wrap py-1 items-center font-semibold text-grey-darkest">
            <div class="flex flex-wrap items-center justify-between md:justify-start md:w-4/5 py-1 w-full">

                @foreach($nav_menu->items as $sub_menu)

                <div class="dropdown pl-6 py-3">
                    <a href="{{ $sub_menu->children->count() ? 'javascript::void(0)' : $sub_menu->link }}" class="dropbtn nav-item py-4">{{ $sub_menu->title }}</a>
                    <div class="dropdown-content mt-8">
                        @foreach($sub_menu->children as $child)
                        <a href="{{ $child->link }}">{{ $child->title }}</a>
                        @endforeach
                    </div>
                </div>

                @endforeach

            </div>
{{--            <div class="w-full md:w-1/5">--}}
{{--                <div class="flex flex-wrap justify-end">--}}
{{--                    @foreach($nav_menu_social->items as $item)--}}
{{--                    <a href="{{ $item->link }}" class="nav-icon no-underline text-teal">--}}
{{--                        <i class="fa {{ $item->svg }}"></i>--}}
{{--                    </a>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</div>
