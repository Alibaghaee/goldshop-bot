@extends(getSiteBladePath('layouts.master'))

@section('title', $content->html_title ?? '')

@section('content')
    
    <div class="container py-8 my-8 leading-loose text-black max-w-lg">
        <h1 class="mb-4">{{ $content->title }}</h1>
        <div class="bg-grey-lighter rounded p-4">
            @if($content->image)
            <div class="float-left">
                <img src="{{ $content->image }}" alt="{{ $content->title }}" class="max-w-full mb-3 rounded">
            </div>
            @endif
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
    
@endsection
