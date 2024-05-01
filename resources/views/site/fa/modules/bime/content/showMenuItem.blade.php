@extends(getSiteBladePath('layouts.master'))

@section('title', $content->title)




@section('content')
    <section class="  pt-12 pb-16 md:py-24 bg-end-dark bg-white">
        <div class="w-full  bg-slate-100 pb-8">
            <div class="container">

                <div class="mx-auto">

                    <div class="min-w-[300px] flex flex-col rounded-md overflow-hidden  mt-3 pt-2">
                        <img class="w-1/3 h-full mx-auto  border-8  border-white rounded rounded-lg"
                             src="{{asset($content->image)}}"
                             alt="{{$content->title}}"/>
                    </div>
                    <div class="w-2/3 mx-auto">
                        <h2 class="text-center text-3xl text-primary font-bold my-10 p-4">
                            {{$content->title}}
                        </h2>
                        <div class=" py-8 line-height-2-5">

                            {!! $content->description !!}

                        </div>


                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
