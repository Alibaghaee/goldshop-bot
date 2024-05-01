{{-- section nine --}}
<div class="flex text-grey-darkest bg-grey-lighter">
    <div class="container leading-loose">
        <div class="flex flex-wrap md:-mx-3 py-4 my-10">
            <div class="w-full md:w-1/3 md:px-3">
                <img class="rounded" src="{{ $section_nine_menu->image }}" alt="{{ $section_nine_menu->name }}">
            </div>
            @foreach($section_nine_menu->items as $item)
            <div class="w-full md:w-1/3 md:px-3">
                <div class="text-xl font-bold mb-2">{{ $item->title }}</div>
                <div>{!! $item->description !!}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>