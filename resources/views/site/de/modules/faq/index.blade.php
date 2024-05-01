@extends(getSiteBladePath('layouts.master'))

@section('title', $faq->name)

@section('content')
    

    <div class="flex text-grey-darkest">
        <div class="container leading-loose">
            <div class="w-full md:w-4/5 mx-auto my-8">

                <div class="text-2xl font-bold mb-8">{{ $faq->title }}</div>

                @foreach($faq->items as $item)
                    <div class="mb-6 bg-grey-lighter rounded p-2 px-4">
                        <div class="font-bold mb-2">{{ $item->title }}</div>
                        <div>{!! $item->description !!}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
