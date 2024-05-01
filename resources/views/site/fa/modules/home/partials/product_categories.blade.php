<div class="leading-loose text-purple-darkest bg-1">
    <div class="flex flex-wrap container py-16">
        <div class="text-4xl font-bold w-full mb-2 text-purple-darkest text-center">محتوای آموزشی</div>
        <div class="w-full md:w-2/5 mx-auto text-sm">
            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون
        </div>

        <div class="flex flex-wrap mt-12">
            @foreach($category_items as $item)
            <div class="w-full md:w-1/3 px-0 md:px-6">
                <a href="{{ $item->products_url }}" class="no-underline text-purple-darkest hover:text-purple-dark">
                    <div class="bg-white rounded p-4 mb-6 flex">
                        <div class="w-16 h-16 bg-green-light rounded-full flex justify-center items-center ml-4">
                            <img class="w-10" src="{{ $item->image }}" alt="icon">
                        </div>
                        <div class="flex flex-col">
                            <div class="font-bold">{{ $item->title }}</div>
                            <div>{{ $item->description }}</div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
    </div>
</div>