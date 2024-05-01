<div class="bg-indigo-dark text-grey-lightest text-xxs md:text-xs flex flex-wrap flex-1">
    <div class="md:flex w-4/5 md:3/4 mx-auto pt-10 pb-4 lg:py-12 flex-wrap">
        <div class="flex flex-wrap flex-col-reverse lg:flex-row">
            <div class="w-full lg:w-2/5 flex items-center px-6 lg:px-0">
                <div class="mr-6">
                    <img src="{{ $footer_menu->image }}" class="w-24 md:w-auto" style="max-width: 550px;" alt="dna">
                </div>
                <div class="opacity-75">{{ $footer_menu->description }}</div>
            </div>

            <div class="w-full lg:w-3/5 flex justify-between items-end mb-8 lg:mb-0">
                <div class="border-l-2 pl-4 ml-3 opacity-75">
                    @foreach($footer_menu->items as $item)
                        <div class="py-1">
                            <a href="{{ locale_url($item->link) }}" class="no-underline text-grey-lightest hover:text-white">{{ $item->title }}</a>
                        </div>
                    @endforeach
                </div>
                <div>
                    <img src="/image/site/medventi-logo.svg" style="width: 80px;" alt="dna">
                </div>
            </div>
        </div>
    </div>
</div>
