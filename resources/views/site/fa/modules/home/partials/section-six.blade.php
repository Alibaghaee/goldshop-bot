{{-- section six --}}
<div class="py-8 text-grey-darkest">
    <div class="container leading-normal py-8">
        <div class="flex flex-wrap -mx-2">
            <div class="w-full md:w-2/5 px-2">
                <img src="{{ imageCache($section_six_menu->image, 550, 680) }}" class="rounded" alt="{{ $section_six_menu->name }}">
            </div>
            <div class="w-full md:w-3/5 px-2">
                <div class="text-2xl border-b pb-2 border-grey-lighter mb-4">{{ $section_six_menu->name }}</div>
                <div class="leading-loose">{!! $section_six_menu->description !!}</div>
                <div class="flex mt-4">
                    <a href="{{ $section_six_menu->link }}" class="rhc-btn rhc-btn-teal rhc-btn-rounded-full rhc-btn-sm inline ml-4">{{ __('messages.know_more') }}</a>
                    {{-- <a href="/" class="rhc-btn rhc-btn-orange rhc-btn-rounded-full rhc-btn-sm inline">تماس بگیرید</a> --}}
                </div>
            </div>
        </div>
    </div>
</div>