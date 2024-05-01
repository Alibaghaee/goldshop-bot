@extends(getSiteBladePath('layouts.master'))

@section('title', $title ?? '')

@section('content')
    
    <div class="bg-grey-lighter">
        <div class="container py-8 leading-loose text-black">
            <div class="flex flex-wrap -mx-2">
                @foreach($contents as $content)
                    <div class="w-full md:w-1/3 px-2 my-4">
                        <div class="shadow rounded bg-white">
                            <a class="text-teal-dark no-underline hover:text-teal" href="{{ $content->url }}">
                                <img src="{{ imageCache($content->image, 300, 200) }}" class="rounded w-full" alt="{{ $content->title }}">
                            </a>
                            <div class="p-4">
                                <h2 class="mb-3 capitalize">
                                    <a class="text-teal-dark no-underline hover:text-teal" href="{{ $content->url }}">
                                        {{ $content->title }}
                                    </a>
                                </h2>
                                <div>
                                    {!! str_limit($content->summary, 300) !!}
                                </div>
                                <div class="mb-1 mt-6 flex justify-end">
                                    <a href="{{ $content->url }}" class="rhc-btn rhc-btn-teal rhc-btn-rounded-full rhc-btn-sm w-24">
                                        {{ __('messages.more') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="w-full">
                    {!! $contents->links() !!}
                </div>
            </div>
        </div>
    </div>
    
@endsection
