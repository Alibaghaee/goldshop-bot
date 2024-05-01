{{-- section eight --}}
<div class="flex text-grey-darkest bg-grey-lighter">
    <div class="container leading-loose">
        <div class="text-center mt-10 border-t-2 pt-8">
            <div class="text-xl -mt-12"><i class="fa fa-angle-down bg-grey-lighter px-6 text-grey"></i></div>
            <div class="text-3xl">{{ $section_eight_menu->name }}</div>
            <div>{!! $section_eight_menu->description !!}</div>
        </div>
        <div class="my-16">
            <div class="owl-carousel country-slider dir-ltr text-center leading-loose" id="slider-6">
              @foreach($section_eight_menu->items as $item)
                <div>
                    <img class="rounded" src="{{ $item->image }}" alt="{{ $item->title }}">
                </div>
              @endforeach
            </div>
        </div>
    </div>
</div>