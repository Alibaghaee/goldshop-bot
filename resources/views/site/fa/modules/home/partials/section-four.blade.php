{{-- section four --}}
<div class="py-8 text-grey-darkest">
    <div class="container leading-normal">
        <div class="text-center leading-loose dir-rtl">
            <h2 class="text-3xl mb-4">{{ $section_four_menu->name }}</h2>
            <div>{!! $section_four_menu->description !!}</div>

            <div class="flex flex-wrap md:-mx-3">
                @if($group = $section_four_menu->items->split(2))
                <div class="w-full md:w-1/3 p-3">
                    <br>
                    <br>
                    @foreach($group->pop() as $item)
                        <div class="flex flex-wrap flex-row-reverse text-right -mx-2 my-4">
                            {{-- <div class="w-full md:w-1/5 px-2">
                                <div class="border-4 border-teal flex h-16 items-center justify-center rounded-full text-4xl text-teal w-16">
                                    <i class="fa {{ $item->svg }}"></i>
                                </div>
                            </div> --}}
                            <div class="w-full px-2">
                                <div class="mb-4 flex justify-end">
                                    <h3 class="border-b-4 border-grey-lighter inline pb-1">{{ $item->title }}</h3>
                                </div>
                                <div class="text-sm">{!! $item->description !!}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="w-full md:w-1/3 p-3">
                    <div class="h-full w-full flex justify-center items-center">
                        <img src="{{ $section_four_menu->image }}" alt="">
                    </div>
                </div>
                <div class="w-full md:w-1/3 p-3">
                    <br>
                    <br>
                    @foreach($group->pop() as $item)
                        <div class="flex flex-wrap text-right -mx-2 my-4">
                            {{-- <div class="w-full md:w-1/5 px-2">
                                <div class="border-4 border-teal flex h-16 items-center justify-center rounded-full text-4xl text-teal w-16">
                                    <i class="fa {{ $item->svg }}"></i>
                                </div>
                            </div> --}}
                            <div class="w-full px-2">
                                <div class="mb-4 flex justify-start">
                                    <h3 class="border-b-4 border-grey-lighter inline pb-1">{{ $item->title }}</h3>
                                </div>
                                <div class="text-sm">{!! $item->description !!}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>