<div class="col-span-10 flex flex-row justify-around lg:justify-between border-y  border-gray-400 py-2 my-2">
    <div class="flex flex-col lg:flex-row text-xs">
        <a class="mr-2 text-blue-600 my-auto " href="{{route('content.index',['locale'=>'fa'])}}">صفحه اصلی </a>

        @foreach($categories as $category)
            @foreach($category->items as $item)
                <a class="pr-2 mx-2  my-auto text-gray-600 hover:text-blue-600"
                   href="{{route('content.index',['locale'=>'fa','category_title'=>$item->name])}}">{{$item->name}} </a>
            @endforeach
        @endforeach


    </div>
    <form method="get" action="{{route('content.index',['locale'=>'fa'])}}"
          class="flex flex-col-reverse lg:flex-row  lg:justify-center text-xs">

        <div class="my-2 lg:my-0 lg:mx-2">
            <button type="submit" class="rounded bg-blue-600 w-full h-full px-1 lg:w-fit">
                <i class="text-white p-1 fa fa-lg fa-search"></i>
            </button>
        </div>
        <div class="flex flex-col lg:flex-row mt-2 lg:mt-0">
            <div class=" ">
                <input type="text"
                       class="bg-gray-100 p-1 rounded lg:w-fit h-full "
                       name="box"
                       placeholder="جستجو">
            </div>
        </div>
    </form>
</div>
