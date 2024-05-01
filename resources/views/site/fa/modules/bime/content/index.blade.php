@extends(getSiteBladePath('layouts.master'))

@section('title', 'سازمان حمل و نقل بار و مسافر شهرداری اسلامشهر')





@section('content')

    <section class="mt-8 pt-12 pb-16 md:py-24 bg-end-white bg-cover">

        <div class="py-12 pb-16 bg-slate-100">
            <div class="container">
                <h2 class="text-center text-3xl text-primary font-bold mb-10">
                </h2>

                <!-- blog cards -->
                <div class="flex flex-row flex-wrap gap-8 pb-4 justify-center">
                    @forelse($contents as $content)

                        <div class="min-w-[300px] flex flex-col rounded-md overflow-hidden bg-white">
                            <img class="h-[200px] xl:h-[300px]" src="{{asset($content->image)}}"
                                 alt="{{$content->title}}"
                                 style="height: 15rem;  "/>
                            <div class="p-5">
                                <h5 class="border-b mt-2 pb-2 text-black  text-md lg:text-xl">
                                    {{$content->title}}
                                </h5>
                                <div class="flex justify-between mt-4">
                                    <span class="text-primary">{{ $content->created_at_fa }}</span>
                                    <a href="{{route('page.show',['page'=>$content->address_slug,'local'=>'fa'])}}"
                                       class="text-[#33ccff]">بیشتر
                                        بخوانید</a>
                                </div>
                            </div>
                        </div>
                    @empty

                        <div class=" font-bold text-red-500 mx-auto mt-20">موردی یافت نشد!</div>
                    @endforelse

                </div>
                <div class="w-full mt-10 ">
                    <div class="mx-auto">
                        {!! $contents->links() !!}
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
