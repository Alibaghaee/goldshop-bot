<div class="w-full md:w-1/3 px-0 mb-12 px-6">
    <div class="bg-white border border-grey-lightest flex flex-wrap rounded">
        <div class="flex justify-center items-center w-full">
            @if($product->image)
                <a href="{{ route('dashboard.show', ['locale' => app()->getLocale(), 'dashboard' => $product->id]) }}" class="w-full">
                    <img src="{{ imageCache($product->image, 477, 293) }}" class="w-full rounded-t" alt="{{ $product->title }}">
                </a>
            @endif
        </div>
        <div class="flex flex-col p-3 px-4 rounded w-full border-b-2 border-grey-lightest">
            <div class="flex flex-col py-3 border-b-2 border-grey-lighter w-full">
                <a href="{{ route('dashboard.show', ['locale' => app()->getLocale(), 'dashboard' => $product->id]) }}" class="no-underline font-bold text-xl text-purple-darkest hover:text-purple-dark w-full">{{ $product->title }}</a>
            </div>
            <div class="py-3 border-b-2 border-grey-lightest">{!! Illuminate\Support\Str::limit($product->detail, 170) !!}</div>
            <div class="flex flex-row pt-3 w-full font-medium">
                <div class="ml-12 flex items-baseline">
                    <div class="flex justify-center items-center bg-grey-lighter rounded-full w-4 h-4 ml-1">
                        <svg class="w-2 h-2 fill-current text-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1026.666748046875 1024"><path d="M1021.833 385.5q-6.5-21.5-23-36t-38.5-17.5l-262-40-117-248q-10-20-28-32t-40-12-40 12-28 32l-117 248-262 40q-22 3-38.5 17.5t-23 36-1.5 43 21 37.5l190 193-45 273q-4 22 4 43t26 34q20 15 44 15 19 0 36-9l234-129 235 129q16 9 35 9 25 0 44-15 18-13 26-34t4-43l-44-273 189-193q16-15 21-37t-1.5-43.5z"/></svg>
                    </div>
                    15 ویدئو
                </div>
                {{-- <div class="ml-12 flex items-baseline">
                    <div class="flex justify-center items-center bg-grey-lighter rounded-full w-4 h-4 ml-1">
                        <svg class="w-2 h-2 fill-current text-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 638 1030"><path d="M68 13l558 476q12 11 12 26t-12 26L68 1017q-19 16-43.5 7T0 991V39Q0 15 24.5 6T68 13z"/></svg>
                    </div>
                    9K بازدید
                </div> --}}
            </div>
            <div class="w-full flex justify-end">
                <a href="{{ route('dashboard.show', ['locale' => app()->getLocale(), 'dashboard' => $product->id]) }}" class="border-2 border-purple-dark cursor-pointer flex h-12 hover:bg-purple-dark hover:text-white items-center justify-center leading-normal rounded text-purple-dark text-white w-32 no-underline">نمایش</a>
            </div>
        </div>
    </div>
</div>
