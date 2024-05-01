{{-- section seven --}}
<div class="flex text-grey-darkest feature-comment" style="background-image: url({{ $section_seven_menu->image }});">
    <div class="container leading-normal py-8">
        <div class="">
            <div class="w-full text-center text-3xl mb-8 font-bold py-2">
                {{ $section_seven_menu->name }}
            </div>
            <div class="owl-carousel comments-slider dir-ltr mt-8 text-center leading-loose" id="slider-6" style="min-height: 250px;">
                @foreach($section_seven_menu->items as $item)   
                <div>
                  <div class="bg-white mt-16 p-3 rounded shadow-md" style="min-height: 250px;">
                    <div class="h-32 w-32 mx-auto -mt-16 mb-8">
                        <img class="rounded-full border-8 border-white shadow-md" src="{{ imageCache($item->image, 100, 100) }}" alt="{{ $item->title }}">
                    </div>
                    <div class="dir-rtl">{!! $item->description !!}</div>
                  </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>