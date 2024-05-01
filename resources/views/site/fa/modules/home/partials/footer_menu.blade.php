<div class="py-3 container text-purple-darkest leading-loose mb-12">
    <div class="flex flex-wrap mt-8">
        <div class="w-full md:w-1/3 p-3">
            <div class="font-bold text-xl mb-3">اخبار</div>
            <div>
                @foreach($last_news as $news)
                <a href="{{ $news->url }}" class="text-purple-darkest hover:text-black no-underline cursor-pointer block">{{ $news->title }}</a>
                @endforeach
            </div>
        </div>
        <div class="w-full md:w-1/3 p-3">
            <div class="font-bold text-xl mb-3">مقالات</div>
            <div>
                @foreach($last_articles as $article)
                <a href="{{ $article->url }}" class="text-purple-darkest hover:text-black no-underline cursor-pointer block">{{ $article->title }}</a>
                @endforeach
            </div>
        </div>
        <div class="w-full md:w-1/3 p-3">
            <div class="font-bold text-xl mb-3">محصولات</div>
            <div>
                @foreach($last_products as $product)
                <a href="{{ $product->url }}" class="text-purple-darkest hover:text-black no-underline cursor-pointer block">{{ $product->title }}</a>
                @endforeach
            </div>
        </div>
    </div>
    </div>