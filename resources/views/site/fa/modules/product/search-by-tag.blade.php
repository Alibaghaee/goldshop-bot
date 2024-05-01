@extends(getSiteBladePath('layouts.master'))

@section('title', 'محصول - ' . $tag->title)

@section('content')
    
    <div class="bg-grey-lightest">
        <div class="container py-8 leading-loose text-black">
                <div class="text-2xl mb-6">نتایج جستجو برای برچسب <span class="font-bold">{{ $tag->title }}</span> :</div>
                @if(!$products->count())
                    <div>موردی یافت نشد.</div>
                @endif
                <div class="w-full">
                    <div class="flex flex-wrap md:-mx-6">
                        @foreach($products as $product)
                            @include('site.fa.modules.product.product', $product)
                        @endforeach
                        <div class="w-full mt-8">
                            {!! $products->appends($_GET)->links() !!}
                        </div>
                    </div>
                </div>
        </div>
    </div>
    
@endsection
