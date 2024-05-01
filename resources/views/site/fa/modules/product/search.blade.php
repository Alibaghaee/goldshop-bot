@extends(getSiteBladePath('layouts.master'))

@section('title', 'جستجو در محصولات')

@section('content')
    
    <div class="bg-grey-lightest">
        <div class="container py-8 leading-loose text-black">
                <div class="text-2xl mb-4">نتایج جستجو:</div>
                @if(!$products->count())
                    <div>موردی یافت نشد.</div>
                @endif
                <div class="w-full">
                    <div class="flex flex-wrap -mx-1">
                        @foreach($products->chunk(4) as $products_chunk)
                        <div class="flex flex-wrap -mx-1 w-full">
                            @foreach($products_chunk as $product)
                                <div class="w-full md:w-1/4 px-1 mb-4">
                                    <div class="bg-white rounded p-2 shadow h-full">
                                        @if($product->image)
                                            <a href="{{ $product->url }}">
                                                <img src="{{ imageCache($product->image, 580, 580) }}" class="w-full rounded" alt="{{ $product->title }}">
                                            </a>
                                        @endif
                                        <div class="">
                                            <h2 class="mb-3 capitalize text-base">
                                                <a class="no-underline text-grey-darkest hover:text-red" href="{{ $product->url }}">
                                                    {{ $product->title }}
                                                </a>
                                            </h2>
                                            <div>
                                            <a href="{{ $product->url }}" class="text-red mb-3 block font-bold text-xl no-underline">قیمت: {{ $product->price_number_format }}</a>
                                            <div class="bg-grey-lighter rounded px-2 py-1 mb-1">کد محصول: {{ $product->code }}</div>
                                                @foreach($product->detail_array as $key => $detail)
                                                    <div class="{{ count($product->detail_array) != ($key + 1) ? 'mb-1' : '' }} bg-grey-lighter rounded px-2 py-1">{{ $detail }}</div>
                                                @endforeach
                                            </div>
                                            {{-- <div class="mb-1 mt-6 flex justify-end">
                                                <a href="{{ $product->url }}" class="rhc-btn rhc-btn-red rhc-btn-rounded-full text-center w-32">
                                                    {{ __('messages.show') }}
                                                </a>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @endforeach
                        <div class="w-full mt-8">
                            {!! $products->links() !!}
                        </div>
                    </div>
                </div>

        </div>
    </div>
    
@endsection
