{{-- section three --}}
<div class="bg-grey-lightest py-8 text-grey-darkest feature-two relative z-10">
    <div class="container leading-normal mt--150">
        <div class="flex flex-wrap md:-mx-3">
            @foreach($section_three_menu->items as $item)
                <div class="w-full my-3 md:w-1/3 md:px-3 flex">
                    <div class="w-full shadow-md rounded bg-white flex flex-wrap flex-col justify-between">
                        <div>
                            <div class="">
                                @if($item->link)
                                    <a class="no-underline text-black hover:text-teal flex cursor-pointer" href="{{ $item->link }}">
                                        <img src="{{ imageCache($item->image, 360, 216) }}" class="w-full rounded-t" alt="">
                                    </a>
                                @else
                                    <img src="{{ imageCache($item->image, 360, 216) }}" class="w-full rounded-t" alt="">
                                @endif
                            </div>
                            <div class="p-4">
                                <div class="border border-teal ml-auto my-2 w-16"></div>
                                @if($item->link)
                                    <div class="text-xl font-bold">
                                        <a class="no-underline text-black hover:text-teal" href="{{ $item->link }}">{{ $item->title }}</a>
                                    </div>
                                @else
                                    <div class="text-xl font-bold">{{ $item->title }}</div>
                                @endif
                                <div class="text text-justify dir-rtl text-center py-4 text-grey-darker leading-loose">{!! $item->description !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>