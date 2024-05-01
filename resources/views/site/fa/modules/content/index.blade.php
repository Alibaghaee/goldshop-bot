@extends(getSiteBladePath('layouts.master'))

@section('title', $title ?? '')

@section('content')

    <div class="text-purple-darkest bg-1 leading-loose">
        <div class="container py-16">
            <div class="flex flex-wrap mb-12">
                <div class="w-full md:w-2/3">
                    <a href="{{ $contents->first()->url }}">
                        <img src="{{ imageCache($contents->first()->image, 1045, 517) }}" class="rounded w-full" alt="{{ $contents->first()->title }}">
                    </a>
                </div>
                <div class="w-full md:w-1/3 p-0 md:pr-4">
                    <div class="text-grey-dark text-right my-2 font-medium tracking-wide">{{ $contents->first()->created_at_fa }}</div>
                    <div class="text-4xl font-bold leading-normal mb-4">
                        <a href="{{ $contents->first()->url }}" class="no-underline cursor-pointer text-purple-darkest hover:text-purple-darker">{{ $contents->first()->title }}</a>
                    </div>
                    <div class="font-medium">{!! str_limit($contents->first()->summary, 300) !!}</div>
                </div>
            </div>

            <div class="flex flex-wrap -mx-4">
                @foreach($contents as $content)
                <div class="w-full md:w-1/3 px-4 mb-12">
                    <div class="w-full">
                        <a href="{{ $content->url }}">
                            <img src="{{ imageCache($content->image, 300, 200) }}" class="rounded w-full" alt="{{ $content->title }}">
                        </a>
                    </div>
                    <div class="w-full p-0 md:pr-4">
                        <div class="text-grey-dark text-left my-2 font-medium tracking-wide">{{ $content->created_at_fa }}</div>
                        <div class="text-3xl font-bold leading-normal mb-4">
                            <a href="{{ $content->url }}" class="no-underline cursor-pointer text-purple-darkest hover:text-purple-darker">{{ $content->title }}</a>
                        </div>
                        <div class="font-medium">{!! str_limit($content->summary, 300) !!}</div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="w-full">
                {!! $contents->links() !!}
            </div>

        </div>
    </div>
    
@endsection
