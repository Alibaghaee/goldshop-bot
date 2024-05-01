<div class="w-5/6 md:3/4 mx-auto py-8 flex justify-between items-center">
    <div class="text-sm md:text-2xl font-semibold">
        <a href="{{ locale_url($nav_menu->link) }}" class="no-underline text-white hover:text-grey-lightest">{{ $nav_menu->name }}</a>
    </div>
    <div class="flex items-center text-xs md:text-base">
        @foreach($nav_menu->items as $item)
            <div class="mr-6 md:mr-24">
                <a href="{{ locale_url($item->link) }}" class="no-underline text-white hover:text-grey-lightest uppercase">@lang($item->title)</a>
            </div>
        @endforeach
        <div class="language relative">

            <img src="/image/site/lang.svg" alt="language" class="flex align-text-bottom md:align-middle md:p-2">
            <div class="absolute flex flex-row-reverse z-50" style="right: -2rem;">
                @foreach($languages->chunk(10) as $languages_chunk)
                    <div class="basis-1/4  language-content" >
                        @foreach($languages_chunk as $language)
                            <a class="language-item " href="/{{ $language->lower_case_key }}">
                                {{ $language->title }}
                                <img src="{{ $language->icon }}"  class="w-6 h-6 rounded-full">
                            </a>
                        @endforeach
                    </div>
                @endforeach
                {{--            <div class="w-48 absolute pin-r z-0 language-content">--}}
                {{--                @foreach($languages as $language)--}}
                {{--                <a class="language-item " href="/{{ $language->lower_case_key }}">--}}
                {{--                    {{ $language->title }}--}}
                {{--                    <img src="{{ $language->icon }}" alt="{{ $language->title }}" class="w-6 h-6 rounded-full">--}}
                {{--                </a>--}}
                {{--                @endforeach--}}
                {{--            </div>--}}
            </div>
        </div>
    </div>
</div>
