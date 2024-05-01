@extends(getSiteBladePath('layouts.master'))

@section('title', $content->html_title ?? '')

@section('content')
    
    <div class="text-purple-darkest bg-1 leading-loose">
        <div class="container py-16 text-black max-w-lg">
            <h1 class="mb-8 leading-normal">{{ $content->title }}</h1>
            <div>
                @if($content->image)
                    <img src="{{ imageCache($content->image, 768) }}" alt="{{ $content->title }}" class="w-full rounded">
                @endif
                <div class="text-grey-dark text-left font-medium tracking-wide mb-3 text-sm">{{ $content->created_at_fa }}</div>
                <div class="mb-12 font text-grey-dark">
                    {!! $content->summary !!}
                </div>

                <div>
                    {!! $content->body !!}
                </div>

                @if($content->file)
                    <div class="mt-8">
                        <a class="rhc-btn rhc-btn-blue" href="{{ $content->file }}">{{ __('messages.download_file') }}</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
@endsection
