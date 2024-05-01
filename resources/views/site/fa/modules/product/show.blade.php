@extends(getSiteBladePath('layouts.master'))

@section('title', $product->html_title ?? '')

@section('content')
    
    <div class="">
        <div class="container md:py-8 md:my-8 leading-loose text-black">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-2/5 px-4">
                    <img src="{{ $product->image }}" alt="{{ $product->title }}" class="w-full rounded">
                </div>
                <div class="w-full md:w-3/5 px-4 flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/2 px-4">
                        <nav class="w-full opacity-75 mb-3">
                          <ol class="list-reset flex text-grey-dark">
                            <li><a href="/fa/products" class="no-underline cursor-pointer text-purple-darkest hover:text-purple-darker">محتوای آموزشی</a></li>
                            {{-- <li><span class="mx-2">/</span></li>
                            <li><a href="{{ $product->category_item->products_url }}" class="no-underline cursor-pointer text-purple-darkest hover:text-purple-darker">{{ $product->category_item->title }}</a></li> --}}
                          </ol>
                        </nav>
                        <h1 class="text-3xl m-0 mb-8 font-bold leading-normal">{{ $product->title }}</h1>
                        <div>
                            <div class="bg-1 font-bold inline-block h-12 px-4 rounded text-purple text-2xl mb-3">{{ number_format($product->price) }} ریال</div>
                            <div class="text-grey-darker font-medium mb-4">
                                {!! $product->detail !!}
                            </div>
                            <div class="flex justify-end">
                                {{-- <div @click="addToCart({{ $product->id }})" class="bg-purple hover:bg-purple-dark rounded py-2 px-6 text-white cursor-pointer h-12 text-center inline-block ">
                                    <svg class="w-4 h-4 fill-current align-middle ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 384"><path d="M384 160H224V0h-64v160H0v64h160v160h64V224h160z"/></svg>
                                    افزودن به سبد خرید
                                </div> --}}
                            </div>
                        </div>
                    </div>
                <div class="w-full md:w-1/2 px-4">
                    <div class="font-bold text-xl">توضیحات:</div>
                    <div>{!! $product->description !!}</div>
                    <div class="mt-8 flex">
                            @if($product->tags->count())
                                <div class="font-bold mb-2 ml-2">برچسب ها:</div>
                                @foreach($product->tags as $tag)
                                    <a href="{{ $tag->link }}" class=" no-underline border-2 border-purple-dark cursor-pointer flex px-4 text-sm hover:bg-purple-dark hover:text-white items-center justify-center rounded text-purple-dark h-8 mx-1">
                                        {{ $tag->title }}
                                    </a>
                                @endforeach
                            @endif
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
