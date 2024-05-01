<div class="leading-loose text-purple-darkest bg-1">
    <div class="flex flex-wrap container py-12">
        <div class="text-4xl font-bold w-full mb-2 text-purple-darkest text-center">محتوای آموزشی</div>

        <div class="flex flex-wrap -mb-12 mt-4 md:mt-12">
            
            @foreach($last_products->chunk(3) as $products_chunk)
            <div class="flex flex-wrap -mx-6">
                @foreach($products_chunk as $product)
                    @include('site.fa.modules.product.product', $product)
                @endforeach
            </div>
            @endforeach

        </div>
    </div>
</div>