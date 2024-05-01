<div class="h-fit w-full text-gray-500 border  rounded  ">
    <h2 class="  font-bold flex flex-row   w-fit mb-2 p-2">
        <div class="px-2 bg-gray-200 pt-1 mt-2 ml-0.5 h-fit  bg-red-500 text-red-500"></div>
        <div class="px-0.5 bg-gray-200 pt-1 mt-2  h-fit  bg-red-500 text-red-500"></div>
        <div class="mx-2 text-gray-800">
            مطالب پربازدید
        </div>
    </h2>
    <div class=" rounded p-4 flex flex-col overflow-auto ">
        @foreach($populars as $popular)

            <div class="flex flex-row mt-1  border-b text-xs  hover:brightness-75 transition-all ">

                <div><img class="w-32" src="{{imageCache($popular->image,120,100)}}" alt="{{$popular->title}}">
                </div>
                <div class="text-xs flex flex-col justify-center w-full">
                    <a class="block p-1 font-bold text-gray-800 "
                       href="{{route('content.show',['local'=>'fa','content'=>$popular->id])}}">{{$popular->title}}</a>
                    <div class="flex flex-col text-right mx-2 py-1">
                        <div class="text-xs  ">
                            <i class="fa fa-calendar"></i>
                            {{$popular->created_at_fa}}</div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
